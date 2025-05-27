<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Biodata;
use App\Models\Package;
use App\Models\Transaction;
use App\Models\Document;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $biodata = Biodata::where('user_id', $user->id)->first();

        if ($user->hasRole('user')) {
            if (empty($biodata) || empty($biodata->name)) {
                return redirect('biodata');
            }

            $data = [
                'transactions' => Transaction::where('user_id', $user->id)->orderBy('created_at', 'desc')->get(),
                'document' => Document::where('user_id', Auth::id())->first(),
            ];
        } else {
            $chartMonthly = Transaction::selectRaw('MONTH(created_at) as month, SUM(total) as total')
                            ->whereYear('created_at', Carbon::now()->year)
                            ->groupBy('month')
                            ->orderBy('month')
                            ->pluck('total', 'month')
                            ->toArray();

            $chartMonthly = array_replace(array_fill(1, 12, 0), $chartMonthly);

            $data = [
                'activities' => Activity::latest()->limit(10)->get(),
                'package' => Package::count(),
                'package_active' => Package::where('status', 'aktif')->count(),
                'package_soldout' => Package::where('status', 'sold out')->count(),
                'daily_income' => Transaction::whereDate('created_at', Carbon::today())->sum('total'),
                'monthly_income' => Transaction::whereMonth('created_at', Carbon::now()->month)
                                    ->whereYear('created_at', Carbon::now()->year)
                                    ->sum('total'),
                'yearly_income' => Transaction::whereYear('created_at', Carbon::now()->year)->sum('total'),
                'chartMonthly' => array_values($chartMonthly),
            ];
        }


        return view('backend.dashboard.index', $data);
    }
}
