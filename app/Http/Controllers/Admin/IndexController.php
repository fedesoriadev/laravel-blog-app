<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * @return string
     */
    public function __invoke(): string
    {
        return 'admin dashboard';
    }
}
