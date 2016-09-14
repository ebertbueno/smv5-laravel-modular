<?php namespace Modules\Api\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;

class ApiTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		 DB::table('oauth_clients')->insert([
					'id' => 'api01',
					'secret' => '123456',
					'name' => 'Admin'
			]);	
		 Model::unguard();
		// $this->call("OthersTableSeeder");
	}

}