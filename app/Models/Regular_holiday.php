<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regular_holiday extends Model
{
    use HasFactory;

    protected $fillable = [
        'day',
        'day_index'
    ];

    public function restaurants() {
        return $this->belongsToMany(Restaurant::class)->withTimestamps();
    }
}

