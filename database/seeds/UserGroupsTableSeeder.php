<?php

use Illuminate\Database\Seeder;

class UserGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            'admin',
            'staff',
            'negotiator'
        ];

        foreach ($groups as $group) {
            \App\Models\UserGroup::create(['name' => $group]);
        }
    }
}
