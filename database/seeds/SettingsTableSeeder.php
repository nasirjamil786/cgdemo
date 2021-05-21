<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            
        'company_name' => 'Computer Gurus Ltd',
        'reg_no' => 'REGNO12345',
        'vat_no' => '',
        'vat_rate' => '',
        'address1' => '39 Blackthorn Avenue',
        'address2' => 'Southborough',
        'area' => '',
        'town' => 'Tunbridge Wells',
        'postcode' => 'TN4 9YD',
        'country' => 'UNITED KINGDOM',
        'phone' => '01892 544199',
        'mobile' => '07816 905720',
        'email' => 'nasir@computergurus.co.uk',
        'web' => 'www.computergurus.co.uk',
        'logo_file' => 'logo_file.jpg',
        'currency' => 'GBP',
        'currency_symbol' => '£',
        'updated_by'=> '1',
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),

        ]);
    }
}
