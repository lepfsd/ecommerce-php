<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ContactFormRequest;
use Session;
use Auth;

class ProductsController extends Controller
{


      public function __construct(){

        $this->middleware("auth", ["except" => "show"]);
      }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(20);
        return view("products.index",["products"=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $product = new Product;
      return view('products.create', ["product" => $product]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $hasFile = $request->hasFile('cover') && $request->cover->isValid();



      $rules = array(
        'title' => 'required',
        'description' => 'required|min:10',
        'pricing' => 'required|numeric',
      );
      $custom_messages = array(
        'title.reqired' => 'Is required',

        'description' => array(
          'required' => 'es requerido',
          'size' => 'minimo asdasdadsd 2',
        ),
        'pricing.required' => 'Is required',
      );
      $validator = Validator::make(Input::all(), $rules, $custom_messages);
      //dd($validator);
      if($validator->fails()){
        return Redirect::to('products/create')
                  ->withErrors($validator)
                  ->withInput(Input::except('password'));
      }
      else{
        $product = new Product;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->pricing = $request->pricing;
        $product->user_id = Auth::user()->id;
        if($hasFile){
          $extension = $request->cover->extension();
          $product->extension = $extension;
        }
        $product->save();
        if($hasFile){
          $request->cover->storeAs('images',"$product->id.$extension");
        }
        Session::flash('message', 'Product saved!');
        return Redirect::to('/products');
      }
    }


    /**
     * Show the form for show the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view("products.show",["product" => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view("products.edit",["product" => $product]);
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
      $rules = array(
        'title' => 'required',
        'description' => 'required',
        'pricing' => 'required|numeric',
      );
      $custom_messages = array(
        'title.required' => 'Is required',
        'description.required' => 'Is required',
        'pricing.required' => 'Is required',
      );
      $validator = Validator::make(Input::all(), $rules, $custom_messages);
      //dd($validator);
      if($validator->fails()){
        return Redirect::to('products/create')
                  ->withErrors($validator)
                  ->withInput(Input::except('password'));
      }
      else{
        $product = Product::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->pricing = $request->pricing;
        $product->user_id = Auth::user()->id;
        $product->save();

        Session::flash('message', 'Product updated!');
        return Redirect::to('/products');
      }
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
        Session::flash('message', 'Product deleted!');
        return Redirect::to('/products');
    }
}
