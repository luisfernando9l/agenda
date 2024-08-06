<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
        /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        User::create(['id' => 1,'name'=> 'Usuário Teste', 'email' =>'teste@underline.com', 'phone' =>NULL, 'department_id' =>NULL,'email_verified_at' => now(), 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi']);
        User::create(['id' => 2,'name'=> 'Usuário Dois', 'email' =>'dois@underline.com', 'phone' =>NULL, 'department_id' =>NULL,'email_verified_at' => now(), 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi']);

        Department::create(['id' => 1,'name'=> 'TI', 'created_by'=>1]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}