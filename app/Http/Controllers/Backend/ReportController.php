<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Exports\ExportReport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.report.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $transactions = Transaction::with('User', 'Package')
                                    ->when($request->start_date, function ($query) {
                                        $query->where('created_at', '>=', $request->start_date);
                                    })
                                    ->when($request->end_date, function ($query) {
                                        $query->where('created_at', '<=', $request->end_date);
                                    })
                                    ->get();

        return response()->json(['transactions' => $transactions]);
    }

    public function export(Request $request)
    {
        return Excel::download(new ExportReport($request->start_date, $request->end_date), 'laporan-transaksi.xlsx');
    }
}
