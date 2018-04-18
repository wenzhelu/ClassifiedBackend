<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $f = \Faker\Factory::create();

        // create 10 fake users
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => "$f->firstName"." $f->lastName",
                'email' => $f->email,
                'phone_number' => $f->e164PhoneNumber,
                'photo_url' => $f->url,
                'role' => $f->randomDigit % 2,
                'address' => $f->address,
                'occupation' => $f->word,
            ]);
        }
    }
}
