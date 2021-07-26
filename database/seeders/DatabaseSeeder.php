<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            GroupSeeder::class
        ]);

        DB::table('users')->insert(
            [
            'username' => 'Quỳnh Lee',
            'gender' => 'nữ',
            'role' => 'admin',
            'password' => Hash::make('quynh2904')
            ]);
        DB::table('users')->insert(
            [
                'username' => 'Tuấn Lê',
                'gender' => 'nam',
                'role' => 'user',
                'group_id' => 1,
                'password' => Hash::make('12345678')
            ]);
    }
}
