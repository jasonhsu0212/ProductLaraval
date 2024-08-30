<?php

namespace App\Helper;
use Illuminate\Support\Facades\Log;


class Logger
{
    public static function info($title,$message)
    {


        Log::info('Info', [$title => $message]);


    }

    public static function warning($message)
    {
        Log::warning('Err', ['message' => $message]);
    }
}
