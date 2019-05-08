<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'display_name' => '管理者',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('123456'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'name' => 'yamada',
                'display_name' => '山田 太郎',
                'email' => 'yamada@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('123456'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'name' => 'tanaka',
                'display_name' => '田中 花子',
                'email' => 'tanaka@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('123456'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
