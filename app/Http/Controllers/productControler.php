<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class productControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('addProduct');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
            
             $request->validate([
                'name' => 'bail|required|string',
                'price' => 'bail|required|numeric',
                'description' => 'bail|nullable|required',
                'image' => 'bail|nullable|image',
                'quantity'=>'bail|nullable|numeric'
            ]);
            
           
            $product = new Product([
                'name' => $request->get('name'),
                'price' => $request->get('price'),
                'description' => $request->get('description')
            ]);
            if($request->file('image')){
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'),$imageName);
              }
            $product->save();
            return redirect('/products/create')->with('success', 'Product saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
            $product = Product::findOrfail($id);
            return Inertia::render('update', [
                  'product' => $product
             ]);
                
            
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
           
            $request->validate([
                'name' => 'bail|required|string',
                'price' => 'bail|required|numeric',
                'description' => 'bail|nullable|required',
                'image' => 'bail|nullable|image',
                'quantity'=>'bail|nullable|numeric'
            ]);
            
           
            $product = Product::find($id);
            $product->name =  $request->get('name');
            $product->price = $request->get('price');
            $product->description = $request->get('description');
            if($request->file('image')){
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'),$imageName);
            $product->image = $imageName;
              }
            $product->save();
            return Inertia::render('update');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
                $product = Product::find($id);
                $product->delete();
                return redirect('/dashboard')->with('success', 'Product deleted!');
    }
}
