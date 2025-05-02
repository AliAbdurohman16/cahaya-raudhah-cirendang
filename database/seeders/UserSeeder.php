<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Biodata;
use App\Models\Document;
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

        $biodataList = [
            [
                'father_name' => 'Budi Saputra',
                'place_birth' => 'Jakarta',
                'date_birth' => '1990-05-12',
                'nik' => '3174091205900001',
                'gender' => 'Laki-laki',
                'address' => 'Jl. Merdeka No. 10, Jakarta Pusat',
                'phone_number' => '081234567890',
                'work' => 'Pegawai Negeri',
                'highest_education' => 'S1',
            ],
            [
                'father_name' => 'Samsul Hadi',
                'place_birth' => 'Bandung',
                'date_birth' => '1992-11-03',
                'nik' => '3276010311920002',
                'gender' => 'Perempuan',
                'address' => 'Jl. Soekarno Hatta No. 45, Bandung',
                'phone_number' => '081345678901',
                'work' => 'Guru',
                'highest_education' => 'S2',
            ],
            [
                'father_name' => 'Mulyadi',
                'place_birth' => 'Surabaya',
                'date_birth' => '1988-07-21',
                'nik' => '3578012107880003',
                'gender' => 'Laki-laki',
                'address' => 'Jl. Basuki Rahmat No. 33, Surabaya',
                'phone_number' => '081256789012',
                'work' => 'Wiraswasta',
                'highest_education' => 'SMA',
            ],
            [
                'father_name' => 'Ahmad Fauzi',
                'place_birth' => 'Medan',
                'date_birth' => '1995-09-14',
                'nik' => '1271031409950004',
                'gender' => 'Perempuan',
                'address' => 'Jl. Gatot Subroto No. 18, Medan',
                'phone_number' => '081267890123',
                'work' => 'Perawat',
                'highest_education' => 'D3',
            ],
            [
                'father_name' => 'Sutrisno',
                'place_birth' => 'Semarang',
                'date_birth' => '1985-03-08',
                'nik' => '3374030803850005',
                'gender' => 'Laki-laki',
                'address' => 'Jl. Pemuda No. 20, Semarang',
                'phone_number' => '081278901234',
                'work' => 'Petani',
                'highest_education' => 'SMP',
            ],
            [
                'father_name' => 'Stefanus',
                'place_birth' => 'Kupang',
                'date_birth' => '1993-12-25',
                'nik' => '5371012512930006',
                'gender' => 'Perempuan',
                'address' => 'Jl. El Tari No. 8, Kupang',
                'phone_number' => '081289012345',
                'work' => 'Dosen',
                'highest_education' => 'S2',
            ],
            [
                'father_name' => 'Taufik Hidayat',
                'place_birth' => 'Makassar',
                'date_birth' => '1991-06-17',
                'nik' => '7371021706910007',
                'gender' => 'Laki-laki',
                'address' => 'Jl. Pettarani No. 5, Makassar',
                'phone_number' => '081290123456',
                'work' => 'Programmer',
                'highest_education' => 'S1',
            ],
            [
                'father_name' => 'Kusnadi',
                'place_birth' => 'Yogyakarta',
                'date_birth' => '1996-02-28',
                'nik' => '3471012802960008',
                'gender' => 'Perempuan',
                'address' => 'Jl. Kaliurang No. 100, Yogyakarta',
                'phone_number' => '081301234567',
                'work' => 'Mahasiswa',
                'highest_education' => 'S1',
            ],
            [
                'father_name' => 'Slamet Riyadi',
                'place_birth' => 'Solo',
                'date_birth' => '1989-10-10',
                'nik' => '3372011010890009',
                'gender' => 'Laki-laki',
                'address' => 'Jl. Slamet Riyadi No. 99, Solo',
                'phone_number' => '081312345678',
                'work' => 'Karyawan Swasta',
                'highest_education' => 'S1',
            ],
            [
                'father_name' => 'Ujang Suryana',
                'place_birth' => 'Garut',
                'date_birth' => '1994-04-04',
                'nik' => '3205010404940010',
                'gender' => 'Perempuan',
                'address' => 'Jl. Ciledug No. 77, Garut',
                'phone_number' => '081323456789',
                'work' => 'Penjahit',
                'highest_education' => 'SMA',
            ],
        ];
        
        foreach ($users as $index => $user) {
            $firstName   = explode(' ', $user['name'])[0];
            $userAvatar = $this->createAvatar($firstName);

            $createdUser = User::create([
                'avatar'             => $userAvatar,
                'name'               => $user['name'],
                'email'              => $user['email'],
                'email_verified_at'  => now(),
                'password'           => bcrypt('1234567890'),
            ]);

            $createdUser->assignRole('user');

            $biodata = $biodataList[$index];

            // Insert to Biodata
            Biodata::create([
                'user_id'           => $createdUser->id,
                'name'              => $user['name'],
                'father_name'       => $biodata['father_name'],
                'place_birth'       => $biodata['place_birth'],
                'date_birth'        => $biodata['date_birth'],
                'nik'               => $biodata['nik'],
                'gender'            => $biodata['gender'],
                'address'           => $biodata['address'],
                'phone_number'      => $biodata['phone_number'],
                'work'              => $biodata['work'],
                'highest_education' => $biodata['highest_education'],
            ]);

            // Insert to Document
            Document::create([
                'user_id'           => $createdUser->id,
            ]);
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
