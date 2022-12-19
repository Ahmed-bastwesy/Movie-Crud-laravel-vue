<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Auth;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        User::truncate();
        DB::table('users')->insert([
            [
                'name'       => 'user',
                'email'      => 'user@user.com',
                'password'   => bcrypt('12345678'),
                'birthdate'  => Carbon::now(),
                'created_at' => Carbon::now(),
            ],
            [
                'name'       => 'user2',
                'email'      => 'user2@test.com',
                'password'   => bcrypt('12345678'),
                'birthdate'  => Carbon::now(),
                'created_at' => Carbon::now(),
            ],
            [
                'name'       => 'user3',
                'email'      => 'user3@test.com',
                'password'   => bcrypt('12345678'),
                'birthdate'  => Carbon::now(),
                'created_at' => Carbon::now(),
            ],
            [
                'name'       => 'user4',
                'email'      => 'user4@test.com',
                'password'   => bcrypt('12345678'),
                'birthdate'  => Carbon::now(),
                'created_at' => Carbon::now(),
            ],
        ]);

        $countUsers = (int) $this->command->ask('How Many users ? ', 10);
        $faker = \Faker\Factory::create();
        foreach (range(1, $countUsers) as $index) {
            DB::table('users')->insert([
                'name'       => $faker->name,
                'email'      => "$index.{$faker->safeEmail}",
                'password'   => bcrypt('12345678'),
                'birthdate'  => Carbon::now(),
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
