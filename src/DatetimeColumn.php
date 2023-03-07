<?php

namespace Mediconesystems\LivewireDatatables;

use Illuminate\Support\Carbon;

class DatetimeColumn extends Column
{
    public $type = 'datetime';
    public $callback;

    public function __construct()
    {
        $this->format();
    }

    public function format($format = null)
    {
        $this->callback = function ($value) use ($format) {
            if ($value && $this->datetimeFormatInternal === 'U') {
                return Carbon::createFromTimestamp($value)->format($format ?? config('livewire-datatables.default_datetime_format'));
            }

            return $value ? Carbon::parse($value)->format($format ?? config('livewire-datatables.default_datetime_format')) : null;
        };

        return $this;
    }

    public function datetimeFormatInternal($format)
    {
        $this->datetimeFormatInternal = $format;
        return $this;
    }
}
