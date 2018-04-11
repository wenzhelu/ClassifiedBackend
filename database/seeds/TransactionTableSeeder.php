<?php

use Illuminate\Database\Seeder;
use App\Transaction;

class TransactionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Transaction::truncate();

        $f = \Faker\Factory::create();

        for ($i = 0; $i < 50; $i++) {
            Transaction::create([
                'item_id' => $f->randomNumber,
                'buyer_id' => $f->randomDigit,
                'seller_id' => $f->randomDigit
            ]);
        }
    }
}
