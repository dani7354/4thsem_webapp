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
        $course->name = "Kursus 1";
        $course->description = "Beskrivelse...";
        $course->start = now()->addDay(10)->addHours(10);
        $course->end = now()->addDay(10)->addHours(12);
        $course->location = "Kontor 2";
        $course->host = "Jens Ringgaard";
        $course->target_audience = "Alle revisorer";
        $course->save();
        $course->participants()->attach(4);
        $course->participants()->attach(6);

        $course = new Course();
        $course->name = "Kursus 2";
        $course->description = "Beskrivelse...";
        $course->start = now()->addDay(16)->addHours(10);
        $course->end = $course->start->addHours(8);
        $course->location = "Kontor 1";
        $course->host = "Jens Ringgaard";
        $course->target_audience = "Alle revisorer";
        $course->save();
        $course->participants()->attach(1);
        $course->participants()->attach(2);
        $course->participants()->attach(3);
        $course->participants()->attach(4);
        $course->participants()->attach(5);
        $course->participants()->attach(6);

        $course = new Course();
        $course->name = "Kursus 3";
        $course->description = "Beskrivelse...";
        $course->start = now()->addDay(8)->addHours(8);
        $course->end = $course->start->addHours(10);
        $course->location = "Kontor 1";
        $course->host = "Jens Ringgaard";
        $course->target_audience = "Alle revisorer";
        $course->save();
        $course->participants()->attach(1);
        $course->participants()->attach(2);
        $course->participants()->attach(3);
        $course->participants()->attach(4);
        $course->participants()->attach(5);
        $course->participants()->attach(6);

        $course = new Course();
        $course->name = "Kursus 4";
        $course->description = "Beskrivelse...";
        $course->start = now()->addDay(80)->addHours(8);
        $course->end = $course->start->addHours(10);
        $course->location = "Kontor 1";
        $course->host = "Jens Ringgaard";
        $course->target_audience = "Alle revisorer";
        $course->save();
        $course->participants()->attach(1);
        $course->participants()->attach(2);
        $course->participants()->attach(3);
        $course->participants()->attach(4);


        $course = new Course();
        $course->name = "Kursus 5";
        $course->description = "Beskrivelse...";
        $course->start = now()->addDay(19)->addHours(8);
        $course->end = $course->start->addHours(10);
        $course->location = "Kontor 1";
        $course->host = "Jens Ringgaard";
        $course->target_audience = "Alle revisorer";
        $course->save();


        $course = new Course();
        $course->name = "Kursus 6";
        $course->description = "Beskrivelse...";
        $course->start = now()->addDay(19)->addHours(8);
        $course->end = $course->start->addHours(10);
        $course->location = "Kontor 2";
        $course->host = "Jens Ringgaard";
        $course->target_audience = "Alle revisorer";
        $course->save();
        $course->participants()->attach(1);


        $course = new Course();
        $course->name = "Kursus 7";
        $course->description = "Beskrivelse...";
        $course->start = now()->addDay(25)->addHours(8);
        $course->end = $course->start->addHours(10);
        $course->location = "Kontor 1";
        $course->host = "Jens Ringgaard";
        $course->target_audience = "Alle revisorer";
        $course->save();
        $course->participants()->attach(4);
        $course->participants()->attach(5);
        $course->participants()->attach(6);

        $course = new Course();
        $course->name = "Kursus 8";
        $course->description = "Beskrivelse...";
        $course->start = now()->addDay(100)->addHours(8);
        $course->end = $course->start->addHours(10);
        $course->location = "Kontor 1";
        $course->host = "Jens Ringgaard";
        $course->target_audience = "Alle revisorer";
        $course->save();
        $course->participants()->attach(1);
        $course->participants()->attach(2);
        $course->participants()->attach(3);
        $course->participants()->attach(4);

        $course = new Course();
        $course->name = "Kursus 9";
        $course->description = "Beskrivelse...";
        $course->start = now()->addDay(91)->addHours(8);
        $course->end = $course->start->addHours(10);
        $course->location = "Kontor 5";
        $course->host = "Jens Ringgaard";
        $course->target_audience = "Alle revisorer";
        $course->save();
        $course->participants()->attach(1);
        $course->participants()->attach(2);
        $course->participants()->attach(3);
        $course->participants()->attach(5);
        $course->participants()->attach(6);

        $course = new Course();
        $course->name = "Kursus 10";
        $course->description = "Beskrivelse...";
        $course->start = now()->addDay(41)->addHours(8);
        $course->end = $course->start->addHours(10);
        $course->location = "Kontor 5";
        $course->host = "Jens Ringgaard";
        $course->target_audience = "Alle revisorer";
        $course->save();
        $course->participants()->attach(1);
        $course->participants()->attach(5);
        $course->participants()->attach(6);


    }
}
