<?php

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		# Disable FK constraints so that all rows can be deleted, even if there's an associated FK
		DB::statement('SET FOREIGN_KEY_CHECKS=0'); 
		DB::statement('TRUNCATE users');

		$client = new User;
		$client->username = 'client';
		$client->usertype = 'client';
		$client->firstname = 'Test';
		$client->lastname = 'Client';
		$client->email = 'client@no-such-domain.com';
		$client->password = Hash::make('test');
		$client->save();

		$coach = new User;
		$coach->username = 'coach';
		$coach->usertype = 'coach';
		$coach->firstname = 'Test';
		$coach->lastname = 'Coach';
		$coach->email = 'coach@p4-life-coach-inc.com';
		$coach->password = Hash::make('test');
		$coach->save();

	}

}
