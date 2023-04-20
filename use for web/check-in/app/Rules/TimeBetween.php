<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;
use app\Models\Restaurant;

class TimeBetween implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        $restaurant = Restaurant::where('user_id', auth()->user()->id)->first();

        $pickupDate = Carbon::parse($value);

        $pickupTime = Carbon::createFromTime($pickupDate->hour, $pickupDate->minute, $pickupDate->second);

        // when the restaurant is open
        // $restaurant = Restaurant::where('id', $restaurant->id)->first();
        $carbonDate = \Carbon\Carbon::createFromFormat('H:i:s', $restaurant->opening_time);
        $formattedTimeOpening = $carbonDate->format('H:i');

        $carbonDate = \Carbon\Carbon::createFromFormat('H:i:s', $restaurant->closing_time);
        $formattedTimeClosing = $carbonDate->format('H:i');


        // $earliestTime = Carbon::createFromTimeString('17:00:00');
        // $lastTime = Carbon::createFromTimeString('23:00:00');

        return $pickupTime->between($formattedTimeOpening, $formattedTimeClosing) ? true : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Please choose the time between the opening and closing time of the restaurant.';
    }
}
