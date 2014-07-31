<?php

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::statement('TRUNCATE users');
		
		$client = new User();
		$client->username = 'client';
		$client->type = 'client';
		$client->firstname = 'Test';
		$client->lastname = 'Client';
		$client->email = 'client@no-such-domain.com';
		$client->password = 'test';
		$client->save();

		$coach = new User();
		$coach->username = 'coach';
		$coach->type = 'coach';
		$coach->firstname = 'Test';
		$coach->lastname = 'Coach';
		$coach->email = 'coach@p4-life-coach-inc.com';
		$coach->password = 'test';
		$coach->save();
		}

}
