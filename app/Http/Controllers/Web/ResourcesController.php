<?php

namespace App\Http\Controllers\Web;

use Illuminate\Routing\Controller;

class ResourcesController extends Controller
{
    public function index()
    {
        return view('resources.index');
    }

    public function guides()
    {
        return view('resources.guides');
    }

    public function tutorials()
    {
        return view('resources.tutorials');
    }
}
