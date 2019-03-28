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
        $d1->name = "Deadline 1";
        $d1->description = "Beskrivelse";
        $d1->date = now()->addDay(1);
        $d1->save();

        $d1 = new Deadline();
        $d1->name = "Deadline 2";
        $d1->description = "Beskrivelse";
        $d1->date = now()->addDay(10);
        $d1->save();

        $d1 = new Deadline();
        $d1->name = "Deadline 3";
        $d1->description = "Beskrivelse";
        $d1->date = now()->addDay(100);
        $d1->save();

        $d1 = new Deadline();
        $d1->name = "Deadline 4";
        $d1->description = "Beskrivelse";
        $d1->date = now()->addDay(7);
        $d1->save();

        $d1 = new Deadline();
        $d1->name = "Deadline 5";
        $d1->description = "Beskrivelse";
        $d1->date = now()->addDay(16);
        $d1->save();

        $d1 = new Deadline();
        $d1->name = "Deadline 6";
        $d1->description = "Beskrivelse";
        $d1->date = now()->addDay(100);
        $d1->save();

        $d1 = new Deadline();
        $d1->name = "Deadline 7";
        $d1->description = "Beskrivelse";
        $d1->date = now()->addDay(15);
        $d1->save();

        $d1 = new Deadline();
        $d1->name = "Deadline 8";
        $d1->description = "Beskrivelse";
        $d1->date = now()->addDay(365);
        $d1->save();

        $d1 = new Deadline();
        $d1->name = "Deadline 9";
        $d1->description = "Beskrivelse";
        $d1->date = now()->addDay(120);
        $d1->save();

    }
}
