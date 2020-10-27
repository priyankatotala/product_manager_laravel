
<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Resources\Prod as ProductResource;
use Illuminate\Support\Facades\DB;
use Auth;

class ProdController extends Controller
{
    
    public function index()
    {
        return Product::all();
        print_r();die();
    }
    
    public function show($id)
    {
        return Product::find($id);
    }
    
    public function store(Request $request)
    {
        return Product::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $prod = Product::findOrFail($id);
        $prod->update($request->all());

        //return $prod;
        return $response->json($prod);
    }

    public function delete(Request $request, $id)
    {
        $article = Product::findOrFail($id);
        $article->delete();

        return 204;
    }
    
}