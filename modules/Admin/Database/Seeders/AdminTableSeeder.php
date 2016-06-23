<?php namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;

class AdminTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('users')->insert([
            'name' => 'Admin',
            'last_name' => str_random(10),
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'language' => 'en',
            'status' => 1,
            'level' => 1
        ]);
		Model::unguard();
		
		// $this->call("OthersTableSeeder");
	}

}