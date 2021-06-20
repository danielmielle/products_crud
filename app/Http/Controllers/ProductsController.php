<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $products = DB::table('products')->get();
        return view('home', compact('products'));
//        return view('home',[
//            'products' => Product::all(),
//        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation of the inputs
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required|max:15',
        ]);
        //request inputs
        $input = new Product();
        $input->name = $request->input('name');
        $input->description = $request->input('description');
        $input->quantity = $request->input('quantity');
        //save inputs
        $input->save();

        return redirect()->route('home')->with('message','Product Stored!')->with('status','success');
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
        //find the product id
        return view('products.edit',[
            'product' => Product::find($id)
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
        //request all inputs to update
        $input = $request->all();
        $input['name']= $request['name'];
        $input['description']= $request['description'];
        $input['quantity'] = $request['quantity'];
        //update inputs
        Product::find($id)->update($input);
        return redirect()->route('home')->with('message','Product Updated!')->with('status','info');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete the id
        Product::destroy($id);
        return response()->json(['status' => 'Product Deleted Successfully!']);
    }
}
