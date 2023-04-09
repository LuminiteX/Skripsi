<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableLayout extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurant_id',
        'floor_number',
        'floor_name',
        'floor_image',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }


    public function tables()
    {
        return $this->hasMany(Table::class);
    }
}
