<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Biodata;

class BiodataController extends Controller
{
    public function index()
    {
        $data['biodata'] = Biodata::where('user_id', Auth::id())->first();
        return view('backend.biodata.index', $data);
    }

    public function store(Request $request, Biodata $biodata)
    {
        $biodata = Biodata::where('user_id', Auth::id())->first();

        $data = $request->validate([
            'name' => 'required',
            'father_name' => 'required',
            'place_birth' => 'required',
            'date_birth' => 'required',
            'nik' => 'required',
            'gender' => 'required',
            'phone_number' => 'required',
            'work' => 'required',
            'highest_education' => 'required',
            'address' => 'required',
        ]);

        $biodata->update($data);

        return redirect()->back()->with('message', 'Data berhasil diperbarui!');
    }
}
