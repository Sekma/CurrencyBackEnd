<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
   

        public function pair_1(){
            return $this->belongsToMany(Pairs::class, 'currency_1_id');
            }
            
            public function pair_2(){
                return $this->belongsToMany(Pairs::class, 'currency_2_id');
                }
}
