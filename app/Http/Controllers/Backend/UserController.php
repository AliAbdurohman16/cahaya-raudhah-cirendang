<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravolt\Avatar\Facade as Avatar;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['users'] = User::whereHas('roles', function ($query) {
                            $query->where('name', '=', 'user');
                        })->orderBy('created_at', 'desc')
                        ->get();

        return view('backend.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $data['user'] = $user;

        return view('backend.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => $user->email === $request->email ? 'required|email' : 'required|email|unique:users,email',
            'password' => $request->password ? 'required|min:8|confirmed' : '',
        ]);

        $isNameChanged = $user->name !== $request->name;

        if ($isNameChanged) {
            $avatarImage = Avatar::create($data['name'][0])
                ->setBackground(sprintf('#%06X', mt_rand(0, 0xFFFFFF))) // Random background color
                ->setDimension(100, 100) // Avatar size
                ->getImageObject(); // Generates the image as a GD object

            $avatarName = Str::random(10) . '.png';
            $avatarPath = 'avatars/' . $avatarName;

            if ($user->avatar && Storage::disk('public')->exists('avatars/' . $user->avatar)) {
                Storage::disk('public')->delete('avatars/' . $user->avatar);
            }

            Storage::disk('public')->put($avatarPath, $avatarImage->encode('png'));
        }

        $data['avatar'] = $avatarName ?? $user->avatar;
        $data['password'] = $request->password ? Hash::make($request->password) : $user->password;
        
        $user->update($data);

        return redirect('users')->with('message', 'Pengguna berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->avatar) {
            Storage::disk('public')->delete('avatars/' . $user->avatar);

            $user->delete();

            return response()->json(['message' => 'Berhasil dihapus!']);
        }
    }
}
