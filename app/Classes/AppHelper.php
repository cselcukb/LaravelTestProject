<?php

namespace App\Classes;

class AppHelper
{
    public static function returnSuccessResponse( $data = [] ) {
        return [
            'success' => true,
            'data' => $data,
        ];
    }
    public static function returnErrorResponse( $message = '' ) {
        return [
            'success' => false,
            'message' => $message,
        ];
    }
}
