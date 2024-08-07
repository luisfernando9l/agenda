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

        Department::create(['id' => 1, 'name' => 'Tecnologia da informação', 'created_by' => 1]);
        Department::create(['id' => 2, 'name' => 'Recursos Humanos', 'created_by' => 1]);
        Department::create(['id' => 3, 'name' => 'Financeiro', 'created_by' => 1]);
        Department::create(['id' => 4, 'name' => 'Marketing', 'created_by' => 1]);
        Department::create(['id' => 5, 'name' => 'Desenvolvimento', 'created_by' => 1]);
        Department::create(['id' => 6, 'name' => 'Suporte Técnico', 'created_by' => 1]);
        Department::create(['id' => 7, 'name' => 'Vendas', 'created_by' => 1]);
        Department::create(['id' => 8, 'name' => 'Logística', 'created_by' => 1]);
        Department::create(['id' => 9, 'name' => 'Jurídico', 'created_by' => 1]);
        Department::create(['id' => 10, 'name' => 'Pesquisa e Desenvolvimento', 'created_by' => 1]);
        Department::create(['id' => 11, 'name' => 'Produção', 'created_by' => 1]);
        Department::create(['id' => 12, 'name' => 'Qualidade', 'created_by' => 1]);
        Department::create(['id' => 13, 'name' => 'Comunicação', 'created_by' => 1]);
        Department::create(['id' => 14, 'name' => 'Administração', 'created_by' => 1]);

        //senha dos usuários: password
        User::create(['id' => 1,'name'=> 'Admin', 'email' =>'admin@xteste.net', 'department_id' => 1,'email_verified_at' => now(), 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi']);
        User::create(['id' => 2,'name'=> 'Usuário', 'email' =>'user@xteste.net', 'department_id' => 2,'email_verified_at' => now(), 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi']);
        User::create(['id' => 3,'name'=> 'Usuário Dois', 'email' =>'userdois@xteste.net', 'department_id' => 3,'email_verified_at' => now(), 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi']);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}