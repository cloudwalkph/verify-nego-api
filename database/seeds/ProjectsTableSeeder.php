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
        $projects = [
            [
                'user_id'   => 2,
                'name'      => 'Wyeth Promil',
                'status'    => 'active',
            ],
            [
                'user_id'   => 2,
                'name'      => 'Ponds University',
                'status'    => 'active',
            ],
            [
                'user_id'   => 2,
                'name'      => 'Close Up',
                'status'    => 'active',
            ]
        ];

        $faker = \Faker\Factory::create();

        foreach ($projects as $project) {

            $newProject = \App\Models\Project::create($project);
        }
    }
}
