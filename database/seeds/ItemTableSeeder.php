<?php

use Illuminate\Database\Seeder;
use App\Item;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Item::truncate();

        $f = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            Item::create([
                'name' => $f->word,
                'description' => $f->text,
                'price' => $f->randomNumber,
                'user_id' => $f->randomDigit + 1,
                'category' => $f->word,
                'purpose' => 0,     // all selling
                // 'photo_url' => $f->url,
                'status' => 0       // all active initially
            ]);
        }
    }
}
