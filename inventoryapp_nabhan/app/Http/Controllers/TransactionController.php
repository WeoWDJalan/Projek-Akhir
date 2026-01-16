<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(){
        // $transactions = Transaction::get();
        return 'test';
    }

    public function create(){
        $products = Products::get();
        return view('transactions.create', ['products' => $products]);
    }

    public function store(Request $request){

    // validation
    $request->validate([
        'products_id' => 'required',
        'type' => 'required',
        'amount' => 'required|numeric',
        'note' => 'required',
    ]);
    
    $id_user = Auth::id();
    
    //DB    Cek ini
    $transactions = new Transaction;
    $transactions->products_id = $request->input('products_id');
    $transactions->type = $request->input('type');
    $transactions->amount = $request->input('amount');
    $transactions->note = $request->input('note');
    $transactions->user_id = $id_user;

    $transactions->save();
    
    // Cek ini
    $products = Products::find($request->input('products_id'));
    if($request->input('type') == 'in'){
        $products->stock += $request->input('amount');
    } else if($request->input('type') == 'out'){
        $products->stock -= $request->input('amount');
    }
    $products->save();

    return redirect('/transactions')->with('success', 'Transaction created successfully!');
    
    }

}
