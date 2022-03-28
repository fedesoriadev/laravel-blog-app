<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class IndexController extends Controller
{
    /**
     * @return View
     */
    public function __invoke(): View
    {
        return view('admin.index');
    }
}
