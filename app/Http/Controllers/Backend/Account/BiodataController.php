<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Biodata;
use Image;
use App\Helpers\Huffman;

class BiodataController extends Controller
{
    public function index()
    {
        $data['biodata'] = Biodata::where('user_id', Auth::id())->first();
        return view('backend.account.biodata.index', $data);
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
            'kk' => empty($biodata->kk) ? 'required|mimes:jpg,png,jpeg|image' : 'mimes:jpg,png,jpeg|image',
            'ktp' => empty($biodata->ktp) ? 'required|mimes:jpg,png,jpeg|image' : 'mimes:jpg,png,jpeg|image',
            'vaccine_certificate' => empty($biodata->vaccine_certificate) ? 'required|mimes:jpg,png,jpeg|image' : 'mimes:jpg,png,jpeg|image',
            'passport' => empty($biodata->passport) ? 'required|mimes:jpg,png,jpeg|image' : 'mimes:jpg,png,jpeg|image',
        ]);

        // Proses kompresi dan penyimpanan file
        if ($request->hasFile('kk')) {
            if ($biodata->kk) {
                Storage::disk('public')->delete('kk/' . $biodata->kk);
            }
            $data['kk'] = $this->compressImage($request->file('kk'), 'kk');
        }

        if ($request->hasFile('ktp')) {
            if ($biodata->ktp) {
                Storage::disk('public')->delete('ktp/' . $biodata->ktp);
            }
            $data['ktp'] = $this->compressImage($request->file('ktp'), 'ktp');
        }

        if ($request->hasFile('vaccine_certificate')) {
            if ($biodata->vaccine_certificate) {
                Storage::disk('public')->delete('vaccine_certificates/' . $biodata->vaccine_certificate);
            }
            $data['vaccine_certificate'] = $this->compressImage($request->file('vaccine_certificate'), 'vaccine_certificates');
        }

        if ($request->hasFile('passport')) {
            if ($biodata->passport) {
                Storage::disk('public')->delete('passports/' . $biodata->passport);
            }
            $data['passport'] = $this->compressImage($request->file('passport'), 'passports');
        }

        $biodata->update($data);

        return redirect()->back()->with('message', 'Data berhasil diperbarui!');
    }

    public function compressImage($image, $folder, $quality = 10)
    {
        // Kompres gambar dengan kualitas yang ditentukan (lossy)
        $img = Image::make($image)->encode('jpg', $quality);
        $rawData = (string) $img;

        // Kompresi dengan Huffman
        $huffman = new Huffman();
        $huffman->buildHuffmanTree($rawData);
        $encodedData = $huffman->encode($rawData);

        // Dekompresi data untuk menghasilkan citra JPG
        $decodedData = $huffman->decode($encodedData); // Mengembalikan data ke bentuk asli

        // Simpan citra JPG hasil dekompresi ke dalam folder yang ditentukan
        $filename = time() . '_' . Auth::user()->name . '_' . $folder . '.jpg';
        Storage::disk('public')->put("{$folder}/{$filename}", $decodedData);

        // Hitung ukuran hasil kompresi Huffman dan ukuran asli
        $compressedSize = strlen($encodedData) / 8; // dalam byte
        $originalSize = strlen($rawData); // dalam byte

        return $filename;
    }

}
