<?php

namespace App\Repositories;

use App\Interfaces\BaseRepositoryInterface;
use App\Models\Invoice;
use App\Models\Grade;
use App\Models\Fee;
use App\Models\Student;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class InvoiceRepository implements BaseRepositoryInterface
{

    public function index()
    {
        $invoices = Invoice::all();
        return view('pages.fees.invoices.index', compact('invoices'));
    }

    public function show($id)
    {
        $student = Student::findorfail($id);
        $fees = Fee::where('class_id', $student->class_id)->get();
        return view('pages.fees.invoices.create', compact('student', 'fees'));
    }

    public function create()
    {
        $Grades = Grade::all();
        $fees = Fee::all();
        return view('pages.fees.invoices.create', compact('Grades', 'fees'));
    }



    public function store($request)
    {

        $invoices_list = $request->invoices_list;
        DB::beginTransaction();

        try {
            foreach ($invoices_list as $single_invoice) {

                $invoice = new Invoice();
                $invoice->student_id = $request->student_id;
                $invoice->fee_id = $single_invoice['fee_id'];
                $invoice->grade_id = $request->grade_id;
                $invoice->class_id = $request->class_id;
                $invoice->invoice_date = date('Y-m-d');
                $invoice->invoice_amount = $single_invoice['amount'];
                $invoice->invoice_description = $single_invoice['description'];
                $invoice->save();

                $Transaction = new Transaction();
                $Transaction->student_id = $request->student_id;
                $Transaction->reference_id = $invoice->id;
                $Transaction->type = "invoice";
                $Transaction->amount = $single_invoice['amount'];
                $Transaction->date = date('Y-m-d');
                $Transaction->description = $single_invoice['description'];
                $Transaction->save();
            }

            DB::commit();
            toastr()->success(trans('messages_trans.success'));
            return redirect()->route('invoices.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request)
    {

        DB::beginTransaction();
        try {
            
            $invoice = Invoice::findorfail($request->id);
            $invoice->fee_id = $request->fee_id;
            $invoice->invoice_amount =  $request->amount;
            $invoice->invoice_description = $request->description;
            $invoice->save();

            $Transaction =  Transaction::where('reference_id',$invoice->id)->where('type','invoice')->first();
            $Transaction->amount = $request->amount;
            $Transaction->description = $request->description;
            $Transaction->save();


            DB::commit();
            toastr()->success(trans('messages_trans.update'));
            return redirect()->route('invoices.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function edit($id)
    {
        $invoice = Invoice::findorfail($id);
        $fees = Fee::all();
        return view('pages.fees.invoices.edit', compact('invoice', 'fees'));
    }

    public function destroy($request)
    {

        Invoice::findorfail($request->id)->delete();
        toastr()->error(trans('messages_trans.delete'));
        return redirect()->route('invoices.index');
    }
}