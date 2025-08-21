<?php

namespace App\Foundation;

use Illuminate\Foundation\Application as LaravelApplication;

class CustomApplication extends LaravelApplication
{
    public function publicPath($path = '')
    {
        $publicPath = '/home/toke8998/public_html';
        return $path ? $publicPath . DIRECTORY_SEPARATOR . $path : $publicPath;
    }
}
