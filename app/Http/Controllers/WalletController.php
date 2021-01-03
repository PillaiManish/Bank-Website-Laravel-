<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\WalletRequest;
use PaytmWallet,Auth;

class WalletController extends Controller
{
    // Get Request on Wallet Page
    public function getWallet(){
        return view('wallet.index');
    }

    // Post Request on Wallet Page
    public function postWallet(WalletRequest $request){
        $payment    = PaytmWallet::with('receive');
        $payment->prepare(['order' => 7281,'user' => Auth::user()->id,'mobile_number' => 9653493920,'email' => Auth::user()->email, 'amount' => $request->input('amount'),'callback_url' => 'http://localhost:8000/walletStatus']);
        return $payment->receive();
    }

    // CallBack URL Function of postWallet
    public function walletCallBack(){
        $transaction = PaytmWallet::with('receive');
        $response       =   $transaction->response();
        if($transaction->isSuccessful()){
            // return redirect()->back()->with('success','Your wallet has been updated');
          }
          else if($transaction->isFailed()){
            // return redirect()->back()->with('success','Your payment has been failed, please try again');
        }
        else if($transaction->isOpen()){
        }
    }
}
