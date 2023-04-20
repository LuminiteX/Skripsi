<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use Carbon\Carbon;

class TimeBetween2 implements Rule
{
    /**
     * The start time of the opening hours.
     *
     * @var string
     */
    protected $startTime;

    /**
     * The end time of the closing hours.
     *
     * @var string
     */
    protected $endTime;
    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($startTime, $endTime)
    {
        $this->startTime = $startTime;
        $this->endTime = $endTime;
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

        $pickupDate = Carbon::parse($value);

        $pickupTime = Carbon::createFromTime($pickupDate->hour, $pickupDate->minute, $pickupDate->second);

        $carbonDate = \Carbon\Carbon::createFromFormat('H:i:s', $this->startTime);
        $formattedTimeOpening = $carbonDate->format('H:i');

        $carbonDate = \Carbon\Carbon::createFromFormat('H:i:s', $this->endTime);
        $formattedTimeClosing = $carbonDate->format('H:i');

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
