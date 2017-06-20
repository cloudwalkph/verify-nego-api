<?php

use Illuminate\Database\Seeder;

class HitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hits = [
            [
                'user_id'           => 3,
                'project_id'        => 1,
                'name'              => 'Jane Doe',
                'email'             => 'jane@dpe.com',
                'contact_number'    => '09121231234',
                'school_name'       => 'Saint Jude Catholic School',
                'designation'       => 'Teacher',
                'address'           => '327 Ycaza, San Miguel, Manila, 1005 Metro Manila',
                'other_details'     => '',
                'location'          => 'NORTH LUZON',
            ],
            [
                'user_id'           => 4,
                'project_id'        => 1,
                'name'              => 'Anna Doe',
                'email'             => 'anna@dpe.com',
                'contact_number'    => '09121231234',
                'school_name'       => 'Colegio de San Juan de Letran',
                'designation'       => 'Teacher',
                'address'           => '151 Muralla St, Intramuros, Manila, 1002 Metro Manila',
                'other_details'     => '',
                'location'          => 'NORTH LUZON',
            ],
            [
                'user_id'           => 3,
                'project_id'        => 1,
                'name'              => 'Jane Doe',
                'email'             => 'jane@dpe.com',
                'contact_number'    => '09121231234',
                'school_name'       => 'Saint Jude Catholic School',
                'designation'       => 'Teacher',
                'address'           => '327 Ycaza, San Miguel, Manila, 1005 Metro Manila',
                'other_details'     => '',
                'location'          => 'NORTH LUZON',
            ],
            [
                'user_id'           => 4,
                'project_id'        => 1,
                'name'              => 'Jane Doe',
                'email'             => 'jane@dpe.com',
                'contact_number'    => '09121231234',
                'school_name'       => 'Saint Stephens High School',
                'designation'       => 'Teacher',
                'address'           => '1425 La Torre St, Tondo, Manila, 1012 Metro Manila',
                'other_details'     => '',
                'location'          => 'NORTH LUZON',
            ],
            [
                'user_id'           => 4,
                'project_id'        => 1,
                'name'              => 'Jane Doe',
                'email'             => 'jane@dpe.com',
                'contact_number'    => '09121231234',
                'school_name'       => 'Philippine Cultural College',
                'designation'       => 'Teacher',
                'address'           => '1253 Jose Abad Santos Ave. Tondo, Manila Philippines 1012',
                'other_details'     => '',
                'location'          => 'NORTH LUZON',
            ],
            [
                'user_id'           => 3,
                'project_id'        => 2,
                'name'              => 'Jane Doe',
                'email'             => 'jane@dpe.com',
                'contact_number'    => '09121231234',
                'school_name'       => 'Philippine Science High School Western Visayas Campus',
                'designation'       => 'Teacher',
                'address'           => 'Metropolis Ave, Barangay Bito-on, Jaro, Iloilo City, 5000 Iloilo',
                'other_details'     => '',
                'location'          => 'VISAYAS',
            ],
            [
                'user_id'           => 4,
                'project_id'        => 2,
                'name'              => 'Jane Doe',
                'email'             => 'jane@dpe.com',
                'contact_number'    => '09121231234',
                'school_name'       => 'Philippine Science High School Central Visayas Campus',
                'designation'       => 'Teacher',
                'address'           => 'Argao, 6021 Cebu',
                'other_details'     => '',
                'location'          => 'NORTH LUZON',
            ],
        ];

        foreach ($hits as $hit) {

            $newhits = \App\Models\Hit::create($hit);
        }
    }
}
