<?php

use Illuminate\Support\Facades\Route;

class MenuActiveHelpers
{

    public static function set_active($uri, $output = 'active')
    {
        if (is_array($uri)) {
            foreach ($uri as $u) {
                if (Route::is($u)) {
                    return $output;
                }
            }
        } else {
            if (Route::is($uri)) {
                return $output;
            }
        }
    }

    public static function set_selected($value, $bind)
    {
        return $value == $bind ? 'selected' : '';
    }
}
