<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distribution extends Model {
    protected $guarded = [];

    /**
     * @param $sum
     * @param $rate
     * @return float|int
     */
    public function sum($sum, $percent, $rate = 0){
        return $rate > 0? ($sum * $percent / 100) / floatval($rate): $sum * $percent / 100;
    }

}
