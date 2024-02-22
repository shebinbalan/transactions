<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
       
                return response()->json([
       
                    "success" => true,
    
                    "message" => "Transaction List",
    
                    "data" => $transactions
       
                ]);
        
    }

   
        public function store(Request $request)
        {
            // Validation rules
            $rules = [
                'amount' => 'required',
                'descriptions' => 'required'
            ];
    
            // Validate the request
            $validator = Validator::make($request->all(), $rules);
    
           
            if ($validator->fails()) {
             
                return response()->json(['error' => $validator->errors()], 422);
            }
    
            
            $transaction = new Transaction;
    
          
            $transaction->amount = $request->input('amount');
            $transaction->descriptions = $request->input('descriptions');
    
          
            $transaction->save();
    
            return response()->json(['message' => 'Transaction stored successfully'], 201);
        }
    
}
