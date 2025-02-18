<?php

namespace App\Console\Commands;

use App\Models\Instansi;
use App\Models\Role;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Console\Command;

class MakeFilamentUserWitnRoleAndInstansi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:filament-user-wit-role-and-instansi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Filament for user and assign a role and instansi for it';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('Nama user');
        $email = $this->ask('Email user');
        $password = $this->secret('Password user');

        // Ambil daftar role yang tersedia
        $roles = Role::pluck('slug')->toArray();

        if (empty($roles)) {
            $this->error('Tidak ada role yang tersedia. Pastikan sudah membuat role dengan Spatie!');
            return;
        }

        // Prompt untuk memilih role
        $role = $this->choice('Pilih role untuk user', $roles, 0);

        // Buat user baru
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
            'role_slug' => $role,
        ]);

        // Tambahkan user ke Filament
        Filament::auth()->login($user);

        $this->info("User {$name} berhasil dibuat dan diberikan role '{$role}'!");
    }
}
