<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->first_name = "Admin";
        $user->last_name = "User";
        $user->email = "admin@admin.test";
        $user->address = "1 Test Lane, Testlands";
        $user->password = bcrypt('123456');
        $user->user_type = 2;
        $user->email_verified_at = \Carbon\Carbon::now();
        $user->save();
    }
}
