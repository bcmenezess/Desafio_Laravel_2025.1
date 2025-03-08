<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = usuarioLogado();
        $query = $request->input('busca');
        $category = $request->input('category');
        $categories = Product::select('category')->distinct()->pluck('category');
        $message = null;

        if($query == ""){
            $products = Product::where('user_id','!=',$user->id);
        }
        else {
            $products = Product::where('name', 'like', $query)
                ->orWhere('description', 'like', $query)
                ->where('user_id','!=',$user->id);
        }

        if($category != ""){
            $products = $products->where('category', $category);
        }

        //dd($products->toSql(), $products->getBindings());

        $products = $products->paginate(5)->appends([
            'busca' => $query,
            'category' => $category
        ]);


        if($products->isEmpty()){
            $message = "Não foi possível encontrar o item buscado";
        }

        return view('user.landing-page',
        compact('products','user', 'message', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
