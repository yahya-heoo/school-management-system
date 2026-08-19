<?php

if (!function_exists('toastr')) {
    function toastr()
    {
        return app('flasher');
    }
}
