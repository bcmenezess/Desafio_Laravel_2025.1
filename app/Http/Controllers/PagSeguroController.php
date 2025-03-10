<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PagSeguroController extends Controller
{
    public function createCheckout(Request $request){
        $url = config('services.pagseguro.checkout_url');
        $token = config('services.pagseguro.token');

        $product = json_decode($request->product,true);
        $quantity_input = $request->quantity_input;


        $item =[
            'name' => $product['name'],
            'quantity' => $quantity_input,
            'unit_amount' => $product['price'] * 100
        ];


        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-type' => 'application/json'
        ])->withoutVerifying()->post($url, [
            'reference_id' => uniqid(),
            'items' => [$item]
        ]);


        if($response->successful()){
            Transaction::create([
                'buyer_id' => usuarioLogado()->id,
                'product_id' => $product['id'],
                'total_price' => $product['price'] * $quantity_input,
                'quantity' => $quantity_input,
                'date' => now()
                //'reference_id' => $response['reference_id'],
                //'status' => 1
            ]);

            //TO DO VERIFICAR SALDO DO COMPRADOR

            $seller = User::find($product['user_id']);
            $seller->balance += $product['price'] * $quantity_input;
            $seller->update(['balance'=>$seller->balance]);

            $query_product = Product::find($product['id']);
            $query_product->quantity -= $quantity_input;
            $query_product->update(['quantity'=>$query_product->quantity]);

            $pay_link = data_get($response->json(),'links.1.href');
            return redirect()->away($pay_link);
        }

        return redirect()->route('erro-checkout');
    }
}
