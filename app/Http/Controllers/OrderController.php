<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Elibyy\TCPDF\Facades\TCPDF;

class OrderController extends Controller
{
    public function index()
        {
        $data['orders'] = Order::orderBy('id','desc')->paginate(5);
        return view('orders.index', $data);
        }
    public function create()
        {
            $products = Product::get(['id','name']);
        return view('orders.create',compact('products'));
    }
    public function store(Request $request)
        {
        $request->validate([
        'customer_name' => 'required',
        'phone' => 'required',
        'product' => 'required',
        'quantity' => 'required'
        ]);
        $rand = rand(20000,30000);
        $quantityArray = $request->quantity;
        
        foreach($request->product as $key=>$val) {
            $pricedata = Product::where('id',$request->product)->first('price');
            $order = new Order;
            $order->customer_name = $request->customer_name;
            $order->orderid = $rand;
            $order->phone = $request->phone;
            $order->product_id = $val;
            $order->quantity = $quantityArray[$key];
            $order->net_amount = $quantityArray[$key]*$pricedata->price;
            $order->save();
        }
        
        return redirect()->route('orders.index')
        ->with('success','Order has been created successfully.');
    }
    public function show(Order $order)
        {
        return view('orders.show',compact('order'));
        } 
    public function edit(Order $order)
        {
            $products = Product::get(['id','name']);
        return view('orders.edit',compact('order','products'));
        }
        public function update(Request $request, $id)
        {
            $request->validate([
                'customer_name' => 'required',
                'phone' => 'required',
                'product' => 'required',
                'quantity' => 'required'
                ]);
        $pricedata = Product::where('id',$request->product)->first('price');
        $order = Order::find($id);
        $order->customer_name = $request->customer_name;
        $order->phone = $request->phone;
        $order->product_id = $request->product;
        $order->quantity = $request->quantity;
        $order->net_amount = $request->quantity*$pricedata->price;
        $order->save();
        return redirect()->route('orders.index')
        ->with('success','Order Has Been updated successfully');
    }
    public function destroy(Order $order)
        {
        $order->delete();
        return redirect()->route('orders.index')
        ->with('success','Order has been deleted successfully');
        }
    public function invoice(Request $request,$orderid) {
        $filename = 'invoice.pdf';
        $orderdetails  = Order::with('product')->where('orderid',$orderid)->get();
        $productdetail ='';
        $total = 0;
        foreach($orderdetails as $detail) {
            $productdetail = $productdetail.$detail->product->name.'*'.$detail->quantity.'='.$detail->net_amount.'</br>';
            $total = $total + $detail->net_amount;
        }
        $data = [
            'title' => 'Invoice!',
            'orderid' => $orderid,
            'productdetail'=> $productdetail,
            'total'=>$total
        ];
  
        $html = view()->make('pdfSample', $data)->render();
  
        $pdf = new TCPDF;
          
        $pdf::SetTitle('Invoice');
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');
  
        $pdf::Output(public_path($filename), 'F');
  
        return response()->download(public_path($filename));
    }    
}
