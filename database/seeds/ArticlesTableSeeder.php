<?php

use App\Article;
use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $a1 = new Article();
        $a1->title = "Artikel 1";
        $a1->content = "Indhold.....";
        $a1->user_id = 3;
        $a1->date_created = now();
        $a1->save();

        $a1 = new Article();
        $a1->title = "Artikel 2";
        $a1->content = "Indhold.....";
        $a1->user_id = 3;
        $a1->date_created = now();
        $a1->save();

        $a1 = new Article();
        $a1->title = "Artikel 3";
        $a1->content = "Indhold.....";
        $a1->user_id = 3;
        $a1->date_created = now();
        $a1->save();

        $a1 = new Article();
        $a1->title = "Artikel 4";
        $a1->content = "Indhold.....";
        $a1->user_id = 3;
        $a1->date_created = now();
        $a1->save();

        $a1 = new Article();
        $a1->title = "Artikel 5";
        $a1->content = "Indhold.....";
        $a1->user_id = 3;
        $a1->date_created = now();
        $a1->save();

        $a1 = new Article();
        $a1->title = "Artikel 6";
        $a1->content = "Indhold.....";
        $a1->user_id = 3;
        $a1->date_created = now();
        $a1->save();

        $a1 = new Article();
        $a1->title = "Artikel 7";
        $a1->content = "Indhold.....";
        $a1->user_id = 3;
        $a1->date_created = now();
        $a1->save();

        $a1 = new Article();
        $a1->title = "Artikel 8";
        $a1->content = "Indhold.....";
        $a1->user_id = 3;
        $a1->date_created = now();
        $a1->save();

        $a1 = new Article();
        $a1->title = "Artikel 9";
        $a1->content = "Indhold.....";
        $a1->user_id = 3;
        $a1->date_created = now();
        $a1->save();

        $a1 = new Article();
        $a1->title = "Artikel 10";
        $a1->content = "Indhold.....";
        $a1->user_id = 3;
        $a1->date_created = now();
        $a1->save();
    }
}
