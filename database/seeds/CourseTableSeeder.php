<?php

use App\Course;
use Illuminate\Database\Seeder;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {


        $course = new Course();
        $course->name = "Lær at afkalke din elkeddel";
        $course->description = "12 timers hyggeligt samvær, hvor vi lærer at afkalke elkedler med forskellige, populære produkter.";
        $course->start = new DateTime('2019-04-10T08:00');
        $course->end = new DateTime('2019-04-10T20:00');
        $course->location = "Kontoret";
        $course->user_id = 1; // Arrangør
        $course->save();
        $course->participants()->attach(1);
        $course->participants()->attach(2);
        $course->participants()->attach(3);
        $course->participants()->attach(4);

        $course = new Course();
        $course->name = "Lær at programmere";
        $course->description = "12 timers hyggeligt samvær, hvor vi lærer at programmere i C#";
        $course->start = new DateTime('2019-05-04T09:30');
        $course->end = new DateTime('2019-05-04T15:30');
        $course->location = "Kontoret";
        $course->user_id = 1;
        $course->save();
        $course->participants()->attach(3);
        $course->participants()->attach(4);


        $course = new Course();
        $course->name = "Lær at tænde for fjernsynet";
        $course->description = "Vi lærer i fællesskab, hvordan man betjener et tv, hvordan man skifter batterier i en fjernbetjening osv.";
        $course->start = new DateTime('2019-07-04T10:00');
        $course->end = new DateTime('2019-07-04T17:00');
        $course->location = "Kontoret";
        $course->user_id = 1;
        $course->save();

        $course = new Course();
        $course->name = "Lær, hvordan man bliver revisor";
        $course->description = "Vi vil bruge nogle timer på at lære, hvordan man laver revision";
        $course->start = new DateTime('2019-07-10T10:00');
        $course->end = new DateTime('2019-07-10T17:00');
        $course->location = "Kontoret";
        $course->user_id = 1;
        $course->save();
        $course->participants()->attach(3);

    }
}
