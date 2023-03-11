<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
        {
        $data['products'] = Product::orderBy('id','desc')->paginate(5);
        return view('products.index', $data);
        }
    public function create()
        {
        return view('products.create');
        }
    public function store(Request $request)
        {
        $request->validate([
        'name' => 'required',
        'image' => 'required',
        'category' => 'required',
        'price' => 'required'
        ]);
        $product = new Product;
        $product->name = $request->name;
        if($request->hasFile('image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = 'products-'.strtotime('now').'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storeAs('public/products/',$fileNameToStore);
    
            $product->image = $fileNameToStore;
            /*if($request->from_pool == 'no') {
               $talent->resume = $img['lv_resume'];
               $res1 = $talent->save();
            }*/
        } else {
            $product->image = '';
        }
        $product->category = $request->category;
        $product->price = $request->price;
        $product->save();
        return redirect()->route('products.index')
        ->with('success','Product has been created successfully.');
    }
    public function show(Product $product)
        {
        return view('products.show',compact('product'));
        } 
    public function edit(Product $product)
        {
        return view('products.edit',compact('product'));
        }
    public function update(Request $request, $id)
        {
            $request->validate([
                'name' => 'required',
                'image' => 'nullable',
                'category' => 'required',
                'price' => 'required'
                ]);
        $product = Product::find($id);
        $product->name = $request->name;
        if($request->hasFile('image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = 'products-'.strtotime('now').'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storeAs('public/products/',$fileNameToStore);
    
            $product->image = $fileNameToStore;
            /*if($request->from_pool == 'no') {
               $talent->resume = $img['lv_resume'];
               $res1 = $talent->save();
            }*/
        }
        $product->category = $request->category;
        $product->price = $request->price;
        $product->save();
        return redirect()->route('products.index')
        ->with('success','Product Has Been updated successfully');
    }
    public function destroy(Product $product)
        {
        $product->delete();
        return redirect()->route('products.index')
        ->with('success','Product has been deleted successfully');
        }
}
