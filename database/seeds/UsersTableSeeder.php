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
                'display_name' => '山田太郎',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('123456'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
