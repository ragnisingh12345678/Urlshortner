<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;    
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        $password = Hash::make('password123');
        $now = now();

        // Raw SQL for SuperAdmin
        DB::statement("
            INSERT INTO users (name, email, password, role, created_at, updated_at) 
            VALUES ('Supreme Admin', 'super@admin.com', '{$password}', 'SuperAdmin', '{$now}', '{$now}')
        ");
    }
}
