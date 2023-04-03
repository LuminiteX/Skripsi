<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewCounter extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_id',
        'count'
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
