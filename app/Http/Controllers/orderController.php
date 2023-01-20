<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class orderController extends Controller
{
    public function index(Product $product)
    {
        
        
            //
            $employee = User::where('role','employee')->get();
            return view('customer.order',compact('product','employee'));
        
    
    }


    public function create()
    {
        $orders = DB ::table('orders') 
        ->where('employee_id' , Auth::user()->id)
        ->join('products','orders.product_id','=','products.id')
        ->join('users','orders.customer_id','=','users.id')
        ->select('products.name as Pname','products.detail','products.price','users.name','users.address','users.mobile','orders.created_at')
        ->get();
        return view('employee.myorder',compact('orders' ));
    
    }

    public function store(Request $request)
    {
        {
      
        $request->validate([
        
            'customer_id'=>'required',
            'employee_id'=>'required',
            'product_id'=>'required',
            
        ]);
        order::create($request->all());

        return redirect()->route('order')->with('success','Product ordered! ');
        
    }

    }

}
