<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Biodata;
use App\Models\Document;

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

    public function validationKK(Request $request, $id)
    {
        $documents = Document::findOrFail($id);

        $documents->update($request->all());

        return redirect()->back()->with('message', 'Data berhasil divalidasi!');
    }
    
    public function validationKTP(Request $request, $id)
    {
        $documents = Document::findOrFail($id);

        $documents->update($request->all());

        return redirect()->back()->with('message', 'Data berhasil divalidasi!');
    }

    public function validationPassportPhoto(Request $request, $id)
    {
        $documents = Document::findOrFail($id);

        $documents->update($request->all());

        return redirect()->back()->with('message', 'Data berhasil divalidasi!');
    }

    public function validationVaccineCertificate(Request $request, $id)
    {
        $documents = Document::findOrFail($id);

        $documents->update($request->all());

        return redirect()->back()->with('message', 'Data berhasil divalidasi!');
    }

    public function validationHealthCertificate(Request $request, $id)
    {
        $documents = Document::findOrFail($id);

        $documents->update($request->all());

        return redirect()->back()->with('message', 'Data berhasil divalidasi!');
    }

    public function validationPassport(Request $request, $id)
    {
        $documents = Document::findOrFail($id);

        $documents->update($request->all());

        return redirect()->back()->with('message', 'Data berhasil divalidasi!');
    }
}