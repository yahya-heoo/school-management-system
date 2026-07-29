<?php



namespace App\Http\Controllers\Finances\Billing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\BaseRepositoryInterface;
use App\Models\Fee;

class InvoiceController extends Controller
{
    protected $invoice_object;

    public function __construct(BaseRepositoryInterface $obj)
    {
        $this->invoice_object = $obj; 
    }
    
    public function index()
    {
        return $this->invoice_object->index();
        
    }

    public function create()
    {
        return $this->invoice_object->create();
        
    }

    public function getAmounts($id)
    {
        $fee = Fee::findOrFail($id);
        return response()->json(['amount' => $fee->fee_amount]);
    }
   
    public function store(Request $request)
    {
        return $this->invoice_object->store($request);
        
    }

    
    public function show($id)
    {
        return $this->invoice_object->show($id);
    }

    
    public function edit($id)
    {
        return $this->invoice_object->edit($id);
    }

    
    public function update(Request $request)
    {
        return $this->invoice_object->update($request);
    }

    
    public function destroy(Request $request)
    {
        return $this->invoice_object->destroy($request);
    }
}