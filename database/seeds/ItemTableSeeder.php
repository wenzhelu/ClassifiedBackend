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

        for ($i = 0; $i < 50; $i++) {
            Item::create([
                'description' => $f->text,
                'price' => $f->randomNumber,
                'user_id' => $i,
                'category' => $f->word,
                'purpose' => $f->randomDigit,
                'photo_url' => $f->url,
                // 'status' => $f->randomDigit,
                'status' => $f->randomDigit
            ]);
        }


    }
}
