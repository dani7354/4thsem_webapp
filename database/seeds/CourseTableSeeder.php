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


        $course1 = new Course();
        $course1->name = "Lær at afkalke din elkeddel";
        $course1->description = "12 timers hyggeligt samvær, hvor vi lærer at afkalke elkedler med forskellige, populære produkter.";
        $course1->start = new DateTime('2019-04-10T08:00');
        $course1->end = new DateTime('2019-04-10T20:00');
        $course1->user_id = 1; // Arrangør
        $course1->save();

        $course2 = new Course();
        $course2->name = "Lær at programmere";
        $course2->description = "12 timers hyggeligt samvær, hvor vi lærer at programmere i C#";
        $course2->start = new DateTime('2019-05-04T09:30');
        $course2->end = new DateTime('2019-05-04T15:30');
        $course2->user_id = 1;
        $course2->save();


        $course3 = new Course();
        $course3->name = "Lær at tænde for fjernsynet";
        $course3->description = "Vi lærer i fællesskab, hvordan man betjener et tv, hvordan man skifter batterier i en fjernbetjening osv.";
        $course3->start = new DateTime('2019-07-04T10:00');
        $course3->end = new DateTime('2019-07-04T17:00');
        $course3->user_id = 1;
        $course3->save();

        $course4 = new Course();
        $course4->name = "Lær, hvordan man bliver revisor";
        $course4->description = "Vi vil bruge nogle timer på at lære, hvordan man laver revision";
        $course4->start = new DateTime('2019-07-10T10:00');
        $course4->end = new DateTime('2019-07-10T17:00');
        $course4->user_id = 1;
        $course4->save();
    }
}
