<?php

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


        $course1 = new \App\Course();
        $course1->name = "Lær at afkalke din elkeddel";
        $course1->description = "12 timers hyggeligt samvær, hvor vi lærer at afkalke elkedler med forskellige, populære produkter.";
        $course1->start = new DateTime('2019-04-04T15:03:01.012345Z');
        $course1->end = new DateTime('2019-04-10T15:03:01.012345Z');
        $course1->user_id = 1;
        $course1->save();

        $course2 = new \App\Course();
        $course2->name = "Lær at programmere";
        $course2->description = "12 timers hyggeligt samvær, hvor vi lærer at programmere i C#";
        $course2->start = new DateTime('2019-04-04T15:03:01.012345Z');
        $course2->end = new DateTime('2019-04-15T15:03:01.012345Z');
        $course2->user_id = 1;
        $course2->save();
    }
}
