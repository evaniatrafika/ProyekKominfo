<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;
use App\Models\Fitur;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'name' => 'Evania Trafika',
            'email' => 'evaniatrafika@gmail.com',
            'password' => bcrypt('12345'),
            'no_hp' => '083143149772',
            'jumlah_kinerja' => '0',
            'role' => 'koordinator'
        ]);
        User::create([
            'name' => 'Budi Tabuti',
            'email' => 'budi@gmail.com',
            'password' => bcrypt('12345'),
            'no_hp' => '087632632132',
            'jumlah_kinerja' => '0',
            'role' => 'koordinator'
        ]);
        User::create([
            'name' => 'Bagas Tarangga',
            'email' => 'bagas@gmail.com',
            'password' => bcrypt('12345'),
            'no_hp' => '083143149772',
            'jumlah_kinerja' => '0',
            'role' => 'programmer'
        ]);
        User::create([
            'name' => 'Rangga Saputra',
            'email' => 'rangga@gmail.com',
            'password' => bcrypt('12345'),
            'no_hp' => '083143149772',
            'jumlah_kinerja' => '0',
            'role' => 'programmer'
        ]);
        User::create([
            'name' => 'Rangga Dwi Saputra',
            'email' => 'ranggadwi@gmail.com',
            'password' => bcrypt('12345'),
            'no_hp' => '083143149772',
            'jumlah_kinerja' => '0',
            'role' => 'pimpinan'
        ]);
        User::create([
            'name' => 'Dwi Saputra',
            'email' => 'dwi@gmail.com',
            'password' => bcrypt('12345'),
            'no_hp' => '083143149772',
            'jumlah_kinerja' => '0',
            'role' => 'BPA'
        ]);
        Project::create([
            'opsi' => 'baru',
             'project' => '0',
             'nama_project' => 'Manajemen Proyek',
             'jenis' => 'sim',
             'deskripsi' => 'ini adalah project',
             'pengaju' => 'Dinas Surabaya',
             'target' => '2023-02-18',
             'mulai' => '2023-02-28',
             'selesai' => '2023-03-30',
             'penginput' => 'Eva',
             'status' => 'verifikasi'
        ]);
    }
}

