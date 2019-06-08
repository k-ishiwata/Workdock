<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
            [
                'title' => 'プロジェクト1',
                'time' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'title' => 'プロジェクト2',
                'time' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],[
                'title' => 'プロジェクト3',
                'time' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
