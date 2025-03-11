<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        $products = Product::where('user_id','!=',$user->id);

        if($query != ""){
            $products->where(function ($subQuery) use ($query) {
                $subQuery->where('name', 'like', "%{$query}%")
                         ->orWhere('description', 'like', "%{$query}%");
            });
        }

        if($category != ""){
            $products = $products->where('category', $category);
        }


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

    public function visuProdutos($id){
        $product = Product::findOrFail($id);
        $seller = User::find($product->user_id);

        return view('user.item-view',compact('product','seller'));
    }

    /**
     * Show the form for creating a new resource.
     */

     public function table(){
        $products = Product::paginate(6);
        return view('admin.products-table',compact('products'));
     }

     public function create(){
        return view('admin.add-product');
    }

    public function store(StoreProductRequest $request)
    {
        $validatedData = $request->validated();
        $logado = usuarioLogado();

        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('products', 'public');
        } else {
            $imagePath = null;
        }

        $product = Product::create([
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'description' => $validatedData['description'],
            'category' => $validatedData['category'],
            'quantity' => $validatedData['quantity'],
            'photo' => $imagePath,
            'user_id' => $logado->id,
        ]);

        if($product){
            return redirect()->route('products-table');
        }

        return redirect()->back();
    }

    public function editView($id){
        $product = Product::findOrFail($id);
        return view('admin.edit-product',compact('product'));
    }

    public function edit(UpdateProductRequest $request, $id){
        $validatedData = $request->validated();
        $product = Product::find($id);

        if ($request->hasFile('photo')) {
            if ($product->photo) {
                Storage::disk('public')->delete($product->photo);
            }

            $imagePath = $request->file('photo')->store('products', 'public');

            $product->photo = $imagePath;
        }

        $product = $product->update([
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'description' => $validatedData['description'],
            'category' => $validatedData['category'],
            'quantity' => $validatedData['quantity'],
            'photo' => $imagePath,
        ]);

        if($product){
            return redirect()->route('products-table');
        }

        return redirect()->back();
    }

    public function deleteView($id){
        $product = Product::find($id);
        return view('admin.delete-product',compact('product'));
    }

    public function delete($id){
        $product = Product::find($id);

        if(isset($product->photo)){
            Storage::disk('public')->delete($product->photo);
        }

        $product->delete();

        return to_route('products-table');
    }
}
