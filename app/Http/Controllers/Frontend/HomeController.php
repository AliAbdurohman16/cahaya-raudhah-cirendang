<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;

class HomeController extends Controller
{
    public function index()
    {
        $data['packages'] = Package::where('status', 'aktif')->orderBy('date', 'desc')->limit(6)->get();

        return view('frontend.index', $data);
    }
}
