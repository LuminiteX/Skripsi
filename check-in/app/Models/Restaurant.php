<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'phone_number',
        'opening_time',
        'closing_time',
        'address',
        'image',
        'rating',
        'view',
        'restaurant_status',
        'restaurant_opening_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }
    public function viewCounters()
    {
        return $this->hasMany(ViewCounter::class);
    }

    public function ratingCounters()
    {
        return $this->hasMany(RatingCounter::class);
    }
}
