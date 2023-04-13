<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'cart_header_id',
        'menu_id',
        'quantity',
        'subtotal',
    ];

    public function cart_header()
    {
        return $this->belongsTo(CartHeader::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
