<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $user = new User();
        $user->email = "admin@admin.com";
        $user->name = "Admin";
        $user->email_verified_at = "2022-04-18 14:28:25";
        $user->password = "$2y$10\$g0ifKATp5/U2aL79j/UhJ.DJONmtQ/32ipVTpKEQzxoCsjE97qFH6";
        $user->is_admin = 1;
        $user->save();
    }
}
