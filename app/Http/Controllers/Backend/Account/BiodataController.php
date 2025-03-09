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

            $kkImageFile = $request->file('kk');

            // liat ukuran gambar sebelum di kompresi
            $kkBeforeCompressed = $this->beforeCompression($kkImageFile);

            // Kompres gambar dan simpan
            $kkCompressed = $this->compressImage($kkImageFile, 'kk');
        
            $data['kk'] = $kkCompressed['filename'];
            $data['compressed_kk_size'] = $kkCompressed['sizeKompresi'];
            $data['original_kk_size'] = $kkBeforeCompressed;
        }

        if ($request->hasFile('ktp')) {
            if ($biodata->ktp) {
                Storage::disk('public')->delete('ktp/' . $biodata->ktp);
            }

            $ktpImageFile = $request->file('ktp');

            // liat ukuran gambar sebelum di kompresi
            $ktpBeforeCompressed = $this->beforeCompression($ktpImageFile);

            // Kompres gambar dan simpan
            $ktpCompressed = $this->compressImage($ktpImageFile, 'ktp');

            $data['ktp'] = $ktpCompressed['filename'];
            $data['compressed_ktp_size'] = $ktpCompressed['sizeKompresi'];
            $data['original_ktp_size'] = $ktpBeforeCompressed;
        }

        if ($request->hasFile('passport_photo')) {
            if ($biodata->passport_photo) {
                Storage::disk('public')->delete('passport_photo/' . $biodata->passport_photo);
            }

            $passportPhotoImageFile = $request->file('passport_photo');

            // liat ukuran gambar sebelum di kompresi
            $passportPhotoBeforeCompressed = $this->beforeCompression($passportPhotoImageFile);

            // Kompres gambar dan simpan
            $passportPhotoCompressed = $this->compressImage($passportPhotoImageFile, 'passport_photo');

            $data['passport_photo'] = $passportPhotoCompressed['filename'];
            $data['compressed_passport_photo_size'] = $passportPhotoCompressed['sizeKompresi'];
            $data['original_passport_photo_size'] = $passportPhotoBeforeCompressed;
        }

        if ($request->hasFile('vaccine_certificate')) {
            if ($biodata->vaccine_certificate) {
                Storage::disk('public')->delete('vaccine_certificates/' . $biodata->vaccine_certificate);
            }
            
            $vaccineCertificateImageFile = $request->file('vaccine_certificate');
            
            // liat ukuran gambar sebelum di kompresi
            $vaccineCertificateBeforeCompressed = $this->beforeCompression($vaccineCertificateImageFile);
            
            // Kompres gambar dan simpan
            $vaccineCertificateCompressed= $this->compressImage($vaccineCertificateImageFile, 'vaccine_certificates');

            $data['vaccine_certificate'] = $vaccineCertificateCompressed['filename'];
            $data['compressed_vaccine_certificate_size'] = $vaccineCertificateCompressed['sizeKompresi'];
            $data['original_vaccine_certificate_size'] = $vaccineCertificateBeforeCompressed;
        }

        if ($request->hasFile('health_certificate')) {
            if ($biodata->health_certificate) {
                Storage::disk('public')->delete('health_certificates/' . $biodata->health_certificate);
            }
            
            $healthCertificateImageFile = $request->file('health_certificate');
            
            // liat ukuran gambar sebelum di kompresi
            $healthCertificateBeforeCompressed = $this->beforeCompression($healthCertificateImageFile);
            
            // Kompres gambar dan simpan
            $healthCertificateCompressed= $this->compressImage($healthCertificateImageFile, 'health_certificates');

            $data['health_certificate'] = $healthCertificateCompressed['filename'];
            $data['compressed_health_certificate_size'] = $healthCertificateCompressed['sizeKompresi'];
            $data['original_health_certificate_size'] = $healthCertificateBeforeCompressed;
        }

        if ($request->hasFile('passport')) {
            if ($biodata->passport) {
                Storage::disk('public')->delete('passports/' . $biodata->passport);
            }

            $passportImageFile = $request->file('passport');

            // liat ukuran gambar sebelum di kompresi
            $passportBeforeCompressed = $this->beforeCompression($passportImageFile);

            // Kompres gambar dan simpan
            $passportCompressed = $this->compressImage($passportImageFile, 'passports');

            $data['passport'] = $passportCompressed['filename'];
            $data['compressed_passport_size'] = $passportCompressed['sizeKompresi'];
            $data['original_passport_size'] = $passportBeforeCompressed;
        }

        $biodata->update($data);

        return redirect()->back()->with('message', 'Data berhasil diperbarui!');
    }

    public function compressImage($image, $folder, $quality = 10)
    {
        // Kompres gambar menggunakan Image Intervention
        $img = Image::make($image)->encode('jpg', $quality);
        $rawData = (string) $img;

        // Kompresi dengan Huffman Encoding
        $huffman = new Huffman();
        $huffman->buildHuffmanTree($rawData);
        $encodedData = $huffman->encode($rawData);

        // Dekompresi data untuk menghasilkan citra JPG
        $decodedData = $huffman->decode($encodedData); // Mengembalikan data ke bentuk asli

        // Simpan citra JPG hasil dekompresi ke dalam folder yang ditentukan
        $filename = time() . '_' . Auth::user()->name . '_' . $folder . '.jpg';
        Storage::disk('public')->put("{$folder}/{$filename}", $decodedData);

        // Pastikan file tersimpan sebelum mengambil informasi
        $filePath = "public/{$folder}/{$filename}"; // Path relatif dari storage Laravel
        $fullFilePath = storage_path("app/public/{$folder}/{$filename}"); // Path lengkap untuk `filesize()`

        if (!file_exists($fullFilePath)) {
            throw new \Exception("Error: File hasil kompresi tidak ditemukan di $fullFilePath");
        }

        // Ambil informasi size setelah kompresi
        $sizeKompresi = $this->formatSize(filesize($fullFilePath));// Ukuran dalam KB

        return [
            'filename' => $filename,
            'sizeKompresi' => $sizeKompresi
        ];
    }

    public function beforeCompression($imageFile)
    {
        return $this->formatSize($imageFile->getSize());
    }

    public function formatSize($sizeBytes)
    {
        $sizeKB = $sizeBytes / 1024; // Konversi ke KB

        // Jika lebih dari 1024 KB (1 MB), konversi ke MB
        return ($sizeKB >= 1024) ? round($sizeKB / 1024, 2) . ' MB' : round($sizeKB, 2) . ' KB';
    }
}
