<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $data['transactions'] = Transaction::orderBy('created_at', 'desc')->get();

        return view('backend.transaction.index', $data);
    }
}
