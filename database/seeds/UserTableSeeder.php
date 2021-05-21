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
        DB::table('users')->insert([

        'user_title' => 'Mrs',
        'first_name' => 'Farah',
        'last_name'=> 'Nasir',
        'name'=> 'Farah Nasir',
        'position' => 'Manager',
        'address1'=> '39 Blackthorn Avenue',
        'address2'=> '',
        'area'=> 'Southborough',
        'town'=> 'Tunbridge Wells',
        'postcode'=> 'TN4 9YD',
        'country'=> "UNITED KINGDOM",
        'phone'=> '01892 544199',
        'mobile'=> '07816 905720',
        'user_status'=> 'Active',
        'notes'=> 'Created by seeder',
        'ipaddress'=> '192.168.0.1',
        'login_device'=> 'mydevice',
        'email'=> 'nasir999@hotmail.com',
        'cc' => 'nasir@computergurus.co.uk',
        'password' => bcrypt('pakistan123'),
        'password_hint'=> 'pakistan123',
        'updated_by'=> '1',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
            
        ]);
    }
}
