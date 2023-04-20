<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // protected $table = 'comment';

    protected $fillable = [
        'restaurant_id',
        'user_id',
        'comment',
        'parent',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function child()
    {
        return $this->hasMany(Comment::class, 'parent');
    }
}
