<?php

use App\Deadline;
use Illuminate\Database\Seeder;

class DeadlinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $d1 = new Deadline();
        $d1->name = "Et regnskab skal laves";
        $d1->description = "Det skal laves ordentligt";
        $d1->date = "2019-04-10T08:00";
        $d1->save();


        $d1 = new Deadline();
        $d1->name = "Der skal være rengjort i køkkenet";
        $d1->description = "Det skal laves ordentligt";
        $d1->date = "2019-04-11T08:00";
        $d1->save();

        $d1 = new Deadline();
        $d1->name = "En anden deadline";
        $d1->description = "jaja";
        $d1->date = "2019-10-11T10:00";
        $d1->save();

    }
}
