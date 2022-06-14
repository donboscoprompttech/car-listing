<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public function Currency(){
        return $this->hasOne(CurrencyCode::class, 'country_id', 'id');
    }
}
