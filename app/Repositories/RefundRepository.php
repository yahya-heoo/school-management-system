<?php
namespace App\Repositories;

use App\Interfaces\BaseRepositoryInterface;
use App\Models\Invoice;
use App\Models\Receipt;
use App\Models\Refund;
use App\Models\Student;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class RefundRepository implements BaseRepositoryInterface{
    
    public function index()
    {
        $refunds = Refund::get();
        return view('pages.refunds.index',compact('refunds'));
    }
    
    public function show($id)
    { 
      $student = Student::findorfail($id);
      $invoices= Invoice::where('student_id', $student->id)->get();
      return view('pages.refunds.create', compact('student','invoices'));
        
    }

    public function edit($id)
    {
        
    }
    
    public function create()
    {
        return view('pages.refunds.create');
    }
    
    
    public function store($request)
    {
        DB::beginTransaction();
        try {

            $refund = new Refund();
            $refund->student_id= $request->student_id;
            $refund->invoice_id =$request->invoice_id;
            $refund->receipt_id= $request->receipt_id;
            $refund->reason=$request->discription;
            $refund->fund_amount=$request->amount;
            $refund->refund_date=date('Y-m-d');    
            $refund->save();

            $transaction = new Transaction();
            $transaction->student_id = $request->student_id;
            $transaction->reference_id = $refund->id;
            $transaction->amount=$request->amount;
            $transaction->type='refund';
            $transaction->discription=$request->discription;
            $transaction->date=date('Y-m-d');
            $transaction->save();
            
        DB::commit();
        toastr()->success(trans('messages_trans.success'));
        return redirect()->route('refunds.index');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }

    public function update($request)
    {
        DB::beginTransaction();
        try {

            $refund = Refund::findorfail($request->id);
            $refund->invoice_id =$request->invoice_id;
            $refund->receipt_id= $request->receipt_id;
            $refund->reason=$request->discription;
            $refund->fund_amount=$request->amount;   
            $refund->save();

            $transaction = Transaction::where('type','refund')->where('reference_id',$refund->id)->first();
            $transaction->amount=$request->amount;
            $transaction->discription=$request->discription;
            $transaction->save();
            
        DB::commit();
        toastr()->success(trans('messages_trans.update'));
        return redirect()->route('refunds.index');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }
    
    public function destroy($request)
    {
        Refund::findorfail($request->id)->delete();
        toastr()->error(trans('messages_trans.delete'));
        return redirect()->route('refunds.index');
    }
}




















?>