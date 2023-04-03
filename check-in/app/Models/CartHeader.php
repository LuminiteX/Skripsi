<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartHeader extends Model
{
    use HasFactory;

    protected $fillable = ['reservation_id', 'total', 'cart_status'];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
