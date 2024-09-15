<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pairs;
use Illuminate\Support\Facades\DB;

class PairController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // $currency = Currency::pluck('name', 'id');

      // $pairs = Pairs::pluck('currency_1_id', 'currency_2_id');
        
    $pairs = DB::table('pairs')
    ->select('pairs.id as pair_id','c1.name as currency_1', 'c2.name as currency_2', 'pairs.exchange', 'pairs.conversions')
    ->join('currencies as c1','pairs.currency_1_id','=','c1.id')
    ->join('currencies as c2','pairs.currency_2_id','=','c2.id')
    ->orderBy('pairs.id')
    ->get(); 
    
        return response()->json([
            'pairs' => $pairs
        ]); 
    }
    
    // the conversion function
   public function convert(string $id, string $value)
   {
   
//créer une jointure pour collecter les données necessaires
     $pairs = DB::table('pairs')
    ->select('pairs.id as pair_id','c1.name as currency_1', 'c2.name as currency_2', 'pairs.exchange')
    ->join('currencies as c1','pairs.currency_1_id','=','c1.id')
    ->join('currencies as c2','pairs.currency_2_id','=','c2.id')
    ->orderBy('pairs.id')
    ->get(); 

//convertir l'objet a un tableau
    $json = json_decode($pairs, true);


    $pair = Pairs::find($id);

    if(!$pair){
        return response()->json([
            'status' => 'error',
            'message' => 'pair not found'
        ]);
    }
    else{
        $newConversion = $pair->conversions+1;
    
        $pair->update(['conversions' => $newConversion]);
    //convertir une quantité de devise
        $result = $value * $json[$id-1]['exchange'];
    
        return response()->json([
            'pair' => $json[$id-1]['currency_1'].' -> '.$json[$id-1]['currency_2'],
            'value to convert' => $value,
            'result' => $result,
            'conversions' => $newConversion
        ]); 
    }
   
   }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'currency_1_id' => '',
            'currency_2_id' => '',
            'exchange' => ''
        ]);

       

       if(empty($request->currency_1_id) || empty($request->currency_2_id) || empty($request->exchange)){

        return response()->json([
            'status' => 'error',
            'message' => 'field not validated'
        ]);
       
       }else{

        Pairs::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'create pair successfully'
        ]);
       }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'exchange' => ''
        ]);

       $pair = Pairs::find($id);

       if(!$pair){
        return response()->json([
            'status' => 'error',
            'message' => 'pair not found'
        ]);
       }
       if(empty($request->exchange)){
        return response()->json([
            'status' => 'error',
            'message' => 'field not validated'
        ]);
       }
       else{
        $pair->update($request->all());
        return response()->json([
            'status' => 'success',
            'message' => 'edit pair successfully'
        ]);
       }
       
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $pair = Pairs::find($id);

        if(!$pair){
            return response()->json([
                'status' => 'error',
                'message' => 'pair not found'
            ]);
        }else{
            $pair->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'delete pair successfully'
            ]);
        }
    }


}
