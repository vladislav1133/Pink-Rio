<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'title'=>'Блог',
                'alias'=>'blog',
            ],
            [
                'title'=>'Компьютеры',
                'alias'=>'computers',
            ],
            [
                'title'=>'Интересное',
                'alias'=>'interesting',
            ],
            [
                'title'=>'Советы',
                'alias'=>'advices',
            ],

        ]);
    }
}
