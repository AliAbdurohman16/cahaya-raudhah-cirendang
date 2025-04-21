<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Laravolt\Avatar\Facade as Avatar;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // owner
        $ownerAvatar = $this->createAvatar('Owner');
        
        $owner = User::create([
            'avatar' => $ownerAvatar,
            'name' => 'Owner',
            'email' => 'owner@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('1234567890'),
        ])->assignRole('owner');

        // admin
        $adminAvatar = $this->createAvatar('Admin');

        $admin = User::create([
            'avatar' => $adminAvatar,
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('1234567890'),
        ])->assignRole('admin');

        // user
        $users = [
            ['name' => 'Andi Saputra',      'email' => 'andi.saputra@example.com'],
            ['name' => 'Rina Marlina',      'email' => 'rina.marlina@example.com'],
            ['name' => 'Dedi Pratama',      'email' => 'dedi.pratama@example.com'],
            ['name' => 'Siti Nurhaliza',    'email' => 'siti.nurhaliza@example.com'],
            ['name' => 'Agus Santoso',      'email' => 'agus.santoso@example.com'],
            ['name' => 'Maria Fransiska',   'email' => 'maria.fransiska@example.com'],
            ['name' => 'Ridwan Kurniawan',  'email' => 'ridwan.kurniawan@example.com'],
            ['name' => 'Dewi Sartika',      'email' => 'dewi.sartika@example.com'],
            ['name' => 'Fajar Nugroho',     'email' => 'fajar.nugroho@example.com'],
            ['name' => 'Lilis Suryani',     'email' => 'lilis.suryani@example.com'],
        ];
        
        foreach ($users as $user) {
            $firstName   = explode(' ', $user['name'])[0];
            $userAvatar = $this->createAvatar($firstName);

            User::create([
                'avatar'             => $userAvatar,
                'name'               => $user['name'],
                'email'              => $user['email'],
                'email_verified_at'  => now(),
                'password'           => bcrypt('1234567890'),
            ])->assignRole('user');
        }        
    }

    protected function createAvatar($name)
    {
        $avatarImage = Avatar::create(strtoupper($name[0]))
            ->setBackground(sprintf('#%06X', mt_rand(0, 0xFFFFFF))) // Random background color
            ->setDimension(100, 100) // Avatar size
            ->getImageObject(); // Generates the image as a GD object

        $avatarName = Str::random(10) . '.png';
        $avatarPath = 'avatars/' . $avatarName;

        Storage::disk('public')->put($avatarPath, $avatarImage->encode('png'));

        return basename($avatarPath);
    }
}
