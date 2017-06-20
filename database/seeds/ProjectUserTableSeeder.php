<?php

use Illuminate\Database\Seeder;

class ProjectUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'user_id'    => 3,
                'project_id' => 1,
            ],
            [
                'user_id'    => 3,
                'project_id' => 2,
            ],
            [
                'user_id'    => 3,
                'project_id' => 3,
            ],
            [
                'user_id'    => 4,
                'project_id' => 1,
            ],
            [
                'user_id'    => 4,
                'project_id' => 2,
            ],
            [
                'user_id'    => 4,
                'project_id' => 2,
            ]
        ];

        foreach ($users as $user) {

            $newProject = \App\Models\ProjectUser::create($user);
        }
    }
}
