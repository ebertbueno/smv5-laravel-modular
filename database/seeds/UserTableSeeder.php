<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('users')->insert([
            'name' => 'Admin',
            'last_name' => str_random(10),
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'language' => 'en',
            'is_staff' => 1,
            'is_active' => 1,
            'is_superuser' => 1
        ]);
    }
}
