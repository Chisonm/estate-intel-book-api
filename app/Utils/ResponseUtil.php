<?php

namespace App\Utils;

class ResponseUtil
{
    /**
     * @param  string  $success
     * @param  string  $message
     * @param  string  $code
     * @param  mixed  $data
     *
     * @return array
     */
    public static function generateResponse(string $success, string $message, $code, $data): array
    {
        return [
            'STATUS'  => $success,
            'STATUS_CODE'  => $code,
            'MESSAGE' => $message,
            'DATA'    => $data,
        ];
    }

    /**
     * @param  string  $error
     * @param  string  $message
     * @param  string  $code
     * @param  mixed  $data
     *
     * @return array
     */
    public static function generateError(string $error, string $message, string $code, $data): array
    {
        return [
            'STATUS'  => $error,
            'STATUS_CODE'  => $code,
            'MESSAGE' => $message,
            'ERROR'   => $data,
        ];
    }
}
