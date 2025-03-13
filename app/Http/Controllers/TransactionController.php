<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function purchasesIndex()
    {
        $transactions = Transaction::where('buyer_id','=',usuarioLogado()->id)->paginate(3);
        return view('user.purchase-history',compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function purchasesHistory(){
        $transactions = Transaction::where('buyer_id','=',usuarioLogado()->id)->get();

        $pdf = Pdf::loadView('user.purchases-pdf', compact('transactions'))->setPaper('a4','landscape');
        return $pdf->stream('user.purchases-pdf');
    }

    public function salesIndex()
    {
        if(isUser()){
            $userId = usuarioLogado()->id;
            $transactions = Transaction::whereHas('product', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })->paginate(3);
        }
        else{
            $transactions = Transaction::paginate(3);
        }
        return view('user.sell-history',compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function salesHistory(){
        if(isUser()){
            $userId = usuarioLogado()->id;
            $transactions = Transaction::whereHas('product', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })->get();
        }
        else{
            $transactions = Transaction::all();
        }

        $pdf = Pdf::loadView('user.sales-pdf', compact('transactions'))->setPaper('a4','landscape');
        return $pdf->stream('user.sales-pdf');
    }
}
