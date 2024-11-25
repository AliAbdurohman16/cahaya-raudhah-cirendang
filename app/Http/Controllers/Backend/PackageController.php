<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Hotel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PackageController extends Controller
{
    public function index()
    {
        $data['packages'] = Package::orderBy('date', 'desc')->get();

        return view('backend.package.index', $data);
    }

    public function create()
    {
        return view('backend.package.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'airline' => 'required|mimes:jpg,png,jpeg|image|max:5024',
            'name' => 'required',
            'passenger' => 'required',
            'date' => 'required',
            'day' => 'required',
            'price' => 'required',
            'star_1' => 'required',
            'name_1' => 'required',
            'city_1' => 'required',
            'star_2' => 'required',
            'name_2' => 'required',
            'city_2' => 'required',
        ]);

        if ($request->hasFile('airline')) {
            $airline = basename($request->file('airline')->store('packages', 'public'));
        }

        $package = Package::create([
            'airline' => $airline,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'passenger' => $request->passenger,
            'date' => $request->date,
            'day' => $request->day,
            'price' => str_replace(['Rp ', '.', ','], ['', '', ''], $request->price),
        ]);

        Hotel::insert([
            [
                'id' => Str::uuid(),
                'package_id' => $package->id,
                'name' => $request->name_1,
                'city' => $request->city_1,
                'star' => $request->star_1,
                'position' => 1,
            ],
            [
                'id' => Str::uuid(),
                'package_id' => $package->id,
                'name' => $request->name_2,
                'city' => $request->city_2,
                'star' => $request->star_2,
                'position' => 2,
            ]
        ]);

        return redirect('packages')->with('message', 'Berhasil ditambahkan!');
    }

    public function edit(Package $package)
    {
        $data['package'] = $package;

        return view('backend.package.edit', $data);
    }

    public function update(Request $request, Package $package)
    {
        $request->validate([
            'airline' => 'mimes:jpg,png,jpeg|image|max:5024',
            'name' => 'required',
            'passenger' => 'required',
            'date' => 'required',
            'day' => 'required',
            'price' => 'required',
            'star_1' => 'required',
            'name_1' => 'required',
            'city_1' => 'required',
            'star_2' => 'required',
            'name_2' => 'required',
            'city_2' => 'required',
        ]);

        $airline = $package->airline;

        if ($request->hasFile('airline')) {
            if ($package->airline) {
                Storage::disk('public')->delete('packages/' . $package->airline);
            }

            $airline = basename($request->file('airline')->store('packages', 'public'));
        }

        $package->update([
            'airline' => $airline,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'passenger' => $request->passenger,
            'date' => $request->date,
            'day' => $request->day,
            'price' => str_replace(['Rp ', '.', ','], ['', '', ''], $request->price),
        ]);

        Hotel::where('package_id', $package->id)->delete();

        Hotel::insert([
            [
                'id' => Str::uuid(),
                'package_id' => $package->id,
                'name' => $request->name_1,
                'city' => $request->city_1,
                'star' => $request->star_1,
                'position' => 1,
            ],
            [
                'id' => Str::uuid(),
                'package_id' => $package->id,
                'name' => $request->name_2,
                'city' => $request->city_2,
                'star' => $request->star_2,
                'position' => 2,
            ]
        ]);

        return redirect('packages')->with('message', 'Berhasil diperbarui!');
    }

    public function destroy(Package $package)
    {
        if ($package->airline) {
            Storage::disk('public')->delete('packages/' . $package->airline);

            $package->delete();

            return response()->json(['message' => 'Berhasil dihapus!']);
        }
    }
}
