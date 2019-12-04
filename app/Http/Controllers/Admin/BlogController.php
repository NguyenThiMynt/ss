<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Routing\Controller;

class BlogController extends Controller
{
    public function index()
    {
        return view('blogs.index');
    }

    public function createBlog()
    {
        return view('blogs.create');
    }
}
