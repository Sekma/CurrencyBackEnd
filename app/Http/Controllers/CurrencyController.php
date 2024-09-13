<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Currency;
use Illuminate\Support\Facades\DB;

class CurrencyController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currency = DB::table('currencies')
    ->select('currencies.id as id','currencies.name as currency')
    ->orderBy('id')
    ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Le service est fonctionnel',
            'currencies'=> $currency
        ]);
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ''
        ]);

       

       if(empty($request->name)){

        return response()->json([
            'status' => 'error',
            'message' => 'field not validated'
        ]);
       
       }else{

        Currency::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'create currency successfully'
        ]);
       }
      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ''
        ]);

        $currency = Currency::find($id);
        
        if(!$currency){
            return response()->json([
                'status' => 'error',
                'message' => 'currency not found'
            ]);
        }if(empty($request->name)){

            return response()->json([
                'status' => 'error',
                'message' => 'field not validated'
            ]);
           
        }else{
    
            $currency->update($request->all());
    
            return response()->json([
                'status' => 'success',
                'message' => 'edit currency successfully'
            ]);
           }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $currency = Currency::find($id);
        
        if(!$currency){
            return response()->json([
                'status' => 'error',
                'message' => 'currency not found'
            ]);
        }else{
            $currency->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'delete currency successfully'
            ]);
        }
        
    }
}
