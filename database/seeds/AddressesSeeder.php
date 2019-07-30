<?php

use Illuminate\Database\Seeder;
use App\Address;

class AddressesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 100;
        factory(Address::class, $count)->create();
    }
}
