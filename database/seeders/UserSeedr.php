<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeedr extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(100)->create();
    }
}
