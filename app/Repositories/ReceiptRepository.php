<?php
namespace App\Repositories;

use App\Models\Receipt;
use App\Models\Student;
use App\Interfaces\BaseRepositoryInterface;
use App\Models\Transaction;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class ReceiptRepository implements BaseRepositoryInterface { 


    public function index(){
        
        $receipts = Receipt::get();
        return view("pages.receipts.index", compact("receipts"));

    }

    public function show($id)
    {
        $student = Student::findorfail($id);
        $invoices = Invoice::where('student_id', $student->id)->get();
        return view("pages.receipts.create", compact("student","invoices"));
        
                
    }
    public function create()
    {
        return view('pages.receipts.create');
    }
    
    public function edit($id)
    {
        $receipt = Receipt::findorfail($id);
        $related_invoices = Invoice::where('student_id',$receipt->student_id)->get();
        return view('pages.receipts.edit', compact('receipt', 'related_invoices'));
    }
    
    public function store($request)
    {
        $receipts_list = $request->receipts_list;

        DB::beginTransaction();
        try {
            foreach($receipts_list as $single_receipt){
                
                $receipt= new Receipt();
                $receipt->student_id = $request->student_id;
                $receipt->invoice_id = $single_receipt['invoice_id'];
                $receipt->debit = $single_receipt['amount'];
                $receipt->receipt_date =date('Y-m-d');
                $receipt->receipt_description = $single_receipt['description'];
                $receipt->save();
                
                $Transaction = new Transaction();
                $Transaction->student_id = $request->student_id;
                $Transaction->reference_id = $receipt->id;
                $Transaction->type = "receipt";
                $Transaction->amount = $single_receipt['amount'];
                $Transaction->date = date('Y-m-d');
                $Transaction->description = $single_receipt['description'];
                $Transaction->save();
                
                
            }
            DB::commit();
            toastr()->success(trans("messages_trans.success"));
            return redirect()->route('receipts.index');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }
        
    public function update($request)
    {
        
        DB::beginTransaction();
        try {
            
                $receipt= Receipt::findorfail($request->id);
                $receipt->invoice_id = $request->invoice_id;
                $receipt->debit = $request->amount;
                $receipt->receipt_description = $request->description;
                $receipt->save();
                
                $Transaction = Transaction::where('type','receipt')->where('reference_id',$receipt->id)->first();
                $Transaction->amount = $request->amount;
                $Transaction->description = $request->description;
                $Transaction->save();
                
                
            
            DB::commit();
            toastr()->success(trans("messages_trans.update"));
            return redirect()->route('receipts.index');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }
        
    
        
    
    public function destroy($request)
    {
        Receipt::findorfail($request->id)->delete();
        toastr()->error(trans('messages_trans.delete'));
        return redirect()->route('receipts.index');
    }
  
}