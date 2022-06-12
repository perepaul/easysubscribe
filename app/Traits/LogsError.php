<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;
use Throwable;

trait LogsError
{
    private function throw(Throwable $th)
    {
        Log::error("$th?->getMessage() in file: $th?->getFile() on line: $th?->getLine()");
    }
}
