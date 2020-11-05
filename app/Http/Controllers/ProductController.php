<?php


namespace App\Http\Controllers;


use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;


class ProductController extends Controller
{ 
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $user =  Auth::user()->id ;
        $rows = DB::table('products')->where('user_id', 'LIKE', $user )->get();
        $count = count($rows);
        $products = Product::latest()->where('user_id', 'LIKE', $user )->paginate($count);
        //return view('products.index',compact('products'))->with('i', (request()->input('page', 1) - 1) * 5);
        // View to display modal box
        return view('products.index1',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
        // date_default_timezone_set("Australia/Melbourne");
        // $zone = getdate();
        // print_r($zone); die();
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
        try{
        request()->validate([
            'name' => 'required',
            'category' => 'required',
            'subcategory' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);


        Product::create($request->all());
        }
        catch (\Exception $exception) {
        return back()->withError('The value you have entered is invalid format. Enter a valid value in this field.')->withInput();
        }


        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show1',compact('product'));
    }
     


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //return view('products.edit1',compact('product'));
        // View to display modal box
        return view('products.edit1',compact('product'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        try{
         request()->validate([
            'name' => 'required', 
            'price' => 'required',
            'quantity' => 'required',
            'category' => 'required',
            'subcategory' => 'required',
        ]);


        $product->update($request->all());
        }
        catch (\Exception $exception) {
        return back()->withError('The value you have entered is invalid format. Enter a valid value in this field.')->withInput();
        }


        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();


        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }

    public function getAllProducts() {
        $products = Product::get()->toJson(JSON_PRETTY_PRINT);
        return response($products, 200);
      }

      public function getProduct($id) {
        if (Product::where('id', $id)->exists()) {
            $product = Product::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($product, 200);
          } else {
            return response()->json([
              "message" => "Product not found"
            ], 404);
          }
      }
      public function createProduct(Request $request) {
        // $product = new Product;
        // $product->name = $request->name;
        // $product->course = $request->course;
        // $product->save();
        Product::create($request->all());
    
        return response()->json([
            "message" => "product record created"
        ], 201);
      }

}