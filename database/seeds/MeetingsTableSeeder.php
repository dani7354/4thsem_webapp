<?php

use App\Meeting;
use Illuminate\Database\Seeder;

class MeetingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $meeting = new Meeting();
        $meeting->name = "Møde 1";
        $meeting->description = "Beskrivelse";
        $meeting->location = "Kontor 1";
        $meeting->host = "Jens Ringgaard";
        $meeting->start = now();
        $meeting->end = now()->addHours(4);
        $meeting->save();


        $meeting = new Meeting();
        $meeting->name = "Møde 2";
        $meeting->description = "Beskrivelse";
        $meeting->location = "Kontor 1";
        $meeting->host = "Jens Ringgaard";
        $meeting->start = now();
        $meeting->end = now()->addHours(2);
        $meeting->save();

        $meeting = new Meeting();
        $meeting->name = "Møde 3";
        $meeting->description = "Beskrivelse";
        $meeting->location = "Kontor 1";
        $meeting->host = "Jens Ringgaard";
        $meeting->start = now();
        $meeting->end = now()->addHours(3);
        $meeting->save();
    }
}
