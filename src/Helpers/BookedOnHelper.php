<?php

namespace Eutranet\Corporate\Helpers;

use Carbon\Carbon;

class BookedOnHelper
{
    /**
     * Get the deadline section for the given deadline date
     *
     * @param Carbon $bookedOn
     * @return string
     */
    public function getBookedOnSection(Carbon $bookedOn): string
    {
        $section  = '';
        if ($bookedOn->isToday()) {
            $section = 'today';
        } elseif ($bookedOn->isTomorrow()) {
            $section = 'tomorrow';
        } elseif ($bookedOn->isFuture()) {
            $section = 'coming';
        } elseif ($bookedOn->isPast()) {
            $section = 'overdue';
        }
        return $section;
    }

    /**
     * make deadline timestamp for a specific deadline section
     *
     * @param $section
     * @return Carbon
     */
    public function makeDeadline($section): Carbon
    {
        $date = new Carbon();
        $date = match ($section) {
            'today' => Carbon::today(),
            'tomorrow' => Carbon::tomorrow(),
            'coming' => Carbon::now()->addDays(2),
            'overdue' => Carbon::yesterday(),
        };
        return $date;
    }
}
