<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
            [
                'title'=>'Главная',
                'path'=>'/',
            ],
            [
                'title'=>'Блог',
                'path'=>'/articles',
            ],
            [
                'title'=>'Компьютеры',
                'path'=>'/articles/cat/computers',
            ],
            [
                'title'=>'Интересное',
                'path'=>'/articles/cat/iteresting',
            ],
            [
                'title'=>'Советы',
                'path'=>'/articles/cat/advices',
            ],
            [
                'title'=>'Портфолио',
                'path'=>'/articles/portfolios',
            ],
            [
                'title'=>'Контакты',
                'path'=>'/articles/contacts',
            ],

        ]);
    }
}
