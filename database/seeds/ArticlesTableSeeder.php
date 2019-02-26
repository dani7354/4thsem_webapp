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
        $a1->title = "Danrevi har fået en ny medlemsvirksomhed";
        $a1->content = "I dag har Danrevi optaget et nyt medlem....";
        $a1->user_id = 1;
        $a1->tags = "#welcome#danrevi";
        $a1->date_created = now();
        $a1->save();

        $a1 = new Article();
        $a1->title = "Danrevi fik fejret 10 års fødselsdag med bajere og kage til alle ansatte";
        $a1->content = "I torsdags kunne Danrevi fejre rund fødselsdag...";
        $a1->user_id = 1;
        $a1->tags = "#welcome#danrevi#birthday";
        $a1->date_created = now();
        $a1->save();

        $a1 = new Article();
        $a1->title = "Et eller andet";
        $a1->content = "Hej";
        $a1->user_id = 1;
        $a1->tags = "";
        $a1->date_created = now();
        $a1->save();
    }
}
