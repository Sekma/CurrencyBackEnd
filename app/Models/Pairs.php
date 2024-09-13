<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pairs extends Model
{
    use HasFactory;

    protected $fillable = [
        'currency_1_id',
        'currency_2_id',
        'exchange',
        'conversions'
    ];

    public function currency_1(){
        return $this->belongsTo(Currency::class, 'currency_1_id');
        }

        public function currency_2(){
            return $this->belongsTo(Currency::class, 'currency_2_id');
            }
}
