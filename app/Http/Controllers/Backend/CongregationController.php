<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Biodata;

class CongregationController extends Controller
{
    public function index()
    {
        $data['congregations'] = Transaction::orderBy('created_at', 'desc')->get();

        return view('backend.congregation.index', $data);
    }

    public function show($id)
    {
        $data['biodata'] = Biodata::where('user_id', $id)->first();

        return view('backend.congregation.show', $data);
    }
}