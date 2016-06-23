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
            'last_name' => 'nistrador',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'language' => 'en',
            'status' => 1,
            'level' => 1
        ]);
    }
}
