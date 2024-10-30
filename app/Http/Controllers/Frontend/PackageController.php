<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    public function index()
    {
        $data['packages'] = Package::where('status', 'aktif')->orderBy('date', 'desc')->paginate(12);

        return view('frontend.package', $data);
    }

    public function search(Request $request)
    {
        $search = $request->input('s');

        $normalizedSearch = str_replace('.', '', $search);

        $packages = Package::where('status', 'aktif')
                            ->where(function($query) use ($search, $normalizedSearch) {
                                $query->where('name', 'LIKE', "%$search%")
                                    ->orWhere('date', 'LIKE', "%$search%")
                                    ->orWhere('day', 'LIKE', "%$search%")
                                    ->orWhereRaw('CAST(price AS CHAR) LIKE ?', ["%$normalizedSearch%"]);
                            })
                            ->orderBy('date', 'desc')
                            ->paginate(21);

        $data = [
            'search' => $search,
            'packages' => $packages,
        ];

        return view('frontend.search', $data);
    }

    public function cart(Package $package)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        if ($package->status == 'sold out') {
            return redirect('package');
        }

        $data['package'] = $package;

        return view('frontend.cart', $data);
    }

    public function pay(Request $request)
    {
        $orderId = uniqid();

        $params = [
            'transaction_details' => [
                'order_id'  => $orderId,
                'gross_amount'  => $request->total,
            ],
            'customer_details' => [
                'first_name'  => Auth::user()->name,
                'phone' => Auth::user()->Biodata->first()->phone_number,
            ]
        ];

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function paySuccess(Request $request)
    {
        $payment_type = $request->payment_type == 'echannel' ? 'bank_transfer' : $request->payment_type;
        $bank = $request->biller_code ? 'mandiri' : ($request->permata_va_number ? 'permata' : $request->bank);

        Transaction::create([
            'id' => $request->order_id,
            'user_id' => Auth::id(),  
            'package_id' => $request->package_id,
            'payment_type' => $payment_type,
            'bank' => $bank,
            'total' => $request->total,
        ]);
        
        $package = Package::find($request->package_id);
        
        $totalTrans = Transaction::where('package_id', $package->id)->count('package_id'); 

        if ($totalTrans == $package->passenger) {
            $package->update(['status' => 'sold out']);
        }

        return response()->json(['success' => true]);
    }
}
