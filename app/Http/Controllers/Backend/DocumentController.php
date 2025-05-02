<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Document;
use Image;
use App\Helpers\Huffman;

class DocumentController extends Controller
{
    public function index()
    {
        $data['document'] = Document::where('user_id', Auth::id())->first();
        return view('backend.document.index', $data);
    }

    public function store(Request $request, Document $document)
    {
        $document = Document::where('user_id', Auth::id())->first();

        $data = $request->validate([
            'kk' => 'mimes:jpg,png,jpeg|image',
            'ktp' => 'mimes:jpg,png,jpeg|image',
            'vaccine_certificate' => 'mimes:jpg,png,jpeg|image',
            'passport' => 'mimes:jpg,png,jpeg|image',
        ]);

        // Proses kompresi dan penyimpanan file
        if ($request->hasFile('kk')) {
            if ($document->kk) {
                Storage::disk('public')->delete('kk/' . $document->kk);
            }

            $kkImageFile = $request->file('kk');

            // Ukuran sebelum kompresi (dalam bytes)
            $kkBeforeCompressedBytes = $kkImageFile->getSize();
            $kkBeforeCompressed = $this->formatSize($kkBeforeCompressedBytes);

            // Kompresi
            $kkCompressed = $this->compressImage($kkImageFile, 'kk');
        
            // Hitung Cr dan Ss
            $stats = $this->calculateCompressionStats($kkBeforeCompressedBytes, $kkCompressed['sizeKompresiBytes']);

            $data['kk'] = $kkCompressed['filename'];
            $data['compressed_kk_size'] = $kkCompressed['sizeKompresi'];
            $data['original_kk_size'] = $kkBeforeCompressed;
            $data['kk_compression_ratio'] = $stats['compression_ratio'] . '%';
            $data['kk_space_saving'] = $stats['space_saving'] . '%';
        }

        if ($request->hasFile('ktp')) {
            if ($document->ktp) {
                Storage::disk('public')->delete('ktp/' . $document->ktp);
            }
        
            $ktpImageFile = $request->file('ktp');

            // Ukuran sebelum kompresi (dalam bytes)
            $ktpBeforeCompressedBytes = $ktpImageFile->getSize();
            $ktpBeforeCompressed = $this->formatSize($ktpBeforeCompressedBytes);

            // Kompresi
            $ktpCompressed = $this->compressImage($ktpImageFile, 'ktp');

            // Hitung Cr dan Ss
            $stats = $this->calculateCompressionStats($ktpBeforeCompressedBytes, $ktpCompressed['sizeKompresiBytes']);
        
            $data['ktp'] = $ktpCompressed['filename'];
            $data['compressed_ktp_size'] = $ktpCompressed['sizeKompresi'];
            $data['original_ktp_size'] = $ktpBeforeCompressed;
            $data['ktp_compression_ratio'] = $stats['compression_ratio'] . '%';
            $data['ktp_space_saving'] = $stats['space_saving'] . '%';
        }
        
        if ($request->hasFile('passport_photo')) {
            if ($document->passport_photo) {
                Storage::disk('public')->delete('passport_photo/' . $document->passport_photo);
            }
        
            $passportPhotoImageFile = $request->file('passport_photo');

            // Ukuran sebelum kompresi (dalam bytes)
            $passportPhotoBeforeCompressedBytes = $passportPhotoImageFile->getSize();
            $passportPhotoBeforeCompressed = $this->formatSize($passportPhotoBeforeCompressedBytes);

            // Kompresi
            $passportPhotoCompressed = $this->compressImage($passportPhotoImageFile, 'passport_photo');

            // Hitung Cr dan Ss
            $stats = $this->calculateCompressionStats($passportPhotoBeforeCompressedBytes, $passportPhotoCompressed['sizeKompresiBytes']);
        
            $data['passport_photo'] = $passportPhotoCompressed['filename'];
            $data['compressed_passport_photo_size'] = $passportPhotoCompressed['sizeKompresi'];
            $data['original_passport_photo_size'] = $passportPhotoBeforeCompressed;
            $data['passport_photo_compression_ratio'] = $stats['compression_ratio'] . '%';
            $data['passport_photo_space_saving'] = $stats['space_saving'] . '%';
        }
        
        if ($request->hasFile('vaccine_certificate')) {
            if ($document->vaccine_certificate) {
                Storage::disk('public')->delete('vaccine_certificates/' . $document->vaccine_certificate);
            }
        
            $vaccineCertificateImageFile = $request->file('vaccine_certificate');

            // Ukuran sebelum kompresi (dalam bytes)
            $vaccineCertificateBeforeCompressedBytes = $vaccineCertificateImageFile->getSize();
            $vaccineCertificateBeforeCompressed = $this->formatSize($vaccineCertificateBeforeCompressedBytes);

            // Kompresi
            $vaccineCertificateCompressed = $this->compressImage($vaccineCertificateImageFile, 'vaccine_certificates');

            // Hitung Cr dan Ss
            $stats = $this->calculateCompressionStats($vaccineCertificateBeforeCompressedBytes, $vaccineCertificateCompressed['sizeKompresiBytes']);
        
            $data['vaccine_certificate'] = $vaccineCertificateCompressed['filename'];
            $data['compressed_vaccine_certificate_size'] = $vaccineCertificateCompressed['sizeKompresi'];
            $data['original_vaccine_certificate_size'] = $vaccineCertificateBeforeCompressed;
            $data['vaccine_certificate_compression_ratio'] = $stats['compression_ratio'] . '%';
            $data['vaccine_certificate_space_saving'] = $stats['space_saving'] . '%';
        }
        
        if ($request->hasFile('health_certificate')) {
            if ($document->health_certificate) {
                Storage::disk('public')->delete('health_certificates/' . $document->health_certificate);
            }
        
            $healthCertificateImageFile = $request->file('health_certificate');

            // Ukuran sebelum kompresi (dalam bytes)
            $healthCertificateBeforeCompressedBytes = $healthCertificateImageFile->getSize();
            $healthCertificateBeforeCompressed = $this->formatSize($healthCertificateBeforeCompressedBytes);

            // Kompresi
            $healthCertificateCompressed = $this->compressImage($healthCertificateImageFile, 'health_certificates');

            // Hitung Cr dan Ss
            $stats = $this->calculateCompressionStats($healthCertificateBeforeCompressedBytes, $healthCertificateCompressed['sizeKompresiBytes']);
        
            $data['health_certificate'] = $healthCertificateCompressed['filename'];
            $data['compressed_health_certificate_size'] = $healthCertificateCompressed['sizeKompresi'];
            $data['original_health_certificate_size'] = $healthCertificateBeforeCompressed;
            $data['health_certificate_compression_ratio'] = $stats['compression_ratio'] . '%';
            $data['health_certificate_space_saving'] = $stats['space_saving'] . '%';
        }
        
        if ($request->hasFile('passport')) {
            if ($document->passport) {
                Storage::disk('public')->delete('passports/' . $document->passport);
            }
        
            $passportImageFile = $request->file('passport');

            // Ukuran sebelum kompresi (dalam bytes)
            $passportBeforeCompressedBytes = $passportImageFile->getSize();
            $passportBeforeCompressed = $this->formatSize($passportBeforeCompressedBytes);

            // Kompresi
            $passportCompressed = $this->compressImage($passportImageFile, 'passports');

            // Hitung Cr dan Ss
            $stats = $this->calculateCompressionStats($passportBeforeCompressedBytes, $passportCompressed['sizeKompresiBytes']);
        
            $data['passport'] = $passportCompressed['filename'];
            $data['compressed_passport_size'] = $passportCompressed['sizeKompresi'];
            $data['original_passport_size'] = $passportBeforeCompressed;
            $data['passport_compression_ratio'] = $stats['compression_ratio'] . '%';
            $data['passport_space_saving'] = $stats['space_saving'] . '%';
        }        

        $document->update($data);

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
            'sizeKompresi' => $this->formatSize(filesize($fullFilePath)), // yang tampil
            'sizeKompresiBytes' => filesize($fullFilePath)
        ];
    }

    public function formatSize($sizeBytes)
    {
        $sizeKB = $sizeBytes / 1024; // Konversi ke KB

        // Jika lebih dari 1024 KB (1 MB), konversi ke MB
        return ($sizeKB >= 1024) ? round($sizeKB / 1024, 2) . ' MB' : round($sizeKB, 2) . ' KB';
    }

    public function calculateCompressionStats($originalSizeBytes, $compressedSizeBytes)
    {
        if ($originalSizeBytes === 0) {
            return ['compression_ratio' => 0, 'space_saving' => 0];
        }

        $compressionRatio = ($compressedSizeBytes / $originalSizeBytes) * 100;
        $spaceSaving = (1 - ($compressedSizeBytes / $originalSizeBytes)) * 100;

        return [
            'compression_ratio' => round($compressionRatio, 2), // dalam persen
            'space_saving' => round($spaceSaving, 2) // dalam persen
        ];
    }

}
