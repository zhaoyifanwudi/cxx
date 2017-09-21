<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassifyController extends Controller
{
    public function list()
    {

        return view('admin/classify/index');
    }
    public function add()
    {
        return view('admin/classify/add');
    }
}
