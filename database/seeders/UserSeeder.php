<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
                'password' => Hash::make('12345678')
            ]);
        DB::table('users')->insert(
            [
                'username' => 'Quang Anh',
                'gender' => 'nam',
                'role' => 'QL',
                'password' => Hash::make('12345678')
            ]);
        DB::table('users')->insert(
            [
                'username' => 'Quân Quân',
                'gender' => 'nam',
                'role' => 'TP',
                'password' => Hash::make('12345678')
            ]);
    }
}
