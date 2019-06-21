<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $with = ['distribution'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function distribution() {
        return $this->hasOne(Distribution::class);
    }
}
