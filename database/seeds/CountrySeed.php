<?php

use Illuminate\Database\Seeder;

class CountrySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries=factory(\App\Models\Countries::class,10)->create();
        dd($countries);
    }
}
