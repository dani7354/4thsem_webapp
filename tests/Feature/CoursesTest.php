<?php

namespace Tests\Feature;

use DateTime;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use App\Course;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CoursesTest extends TestCase
{

    /**
     * A basic feature test example.
     *
     * @return void
     */

    // READ
    public function testCanGetAllCourses()
    {
        $response = $this->get('/api/courses/');
        $response->assertStatus(200);
    }
    public function testCanGetCourse()
    {
        $course =  Course::get()->first();

        $response = $this->get('/api/courses/' . $course->id);
        $response->assertStatus(200);

    }
    public function testCanGetParticipantsForCourse()
    {
        $course =  Course::get()->first();
        $response = $this->get('/api/courses/' . $course->id . '/participants');
        $response->assertStatus(200);

    }

    // CREATE

    public function testCreateCourse(){

        $body = array(
            'name' => 'Madkursus',
            'description' => 'Lær at lave italiensk mad',
            'start' => '2019-04-10T08:00',
            'end' => '2019-04-10T20:00',
            'location' => 'Køkken 2',
            'user_id' => 1

        );


        $response = $this->post('/api/courses', $body);
        $response->assertStatus(201);
    }

    public function testCreateReturns400IfFieldIsMissing()
    {

        $body = array(
         /*   'name' => 'Madkursus',*/
            'description' => 'Lær at lave italiensk mad',
            'start' => '2019-04-10T08:00',
            'end' => '2019-04-10T20:00',
            'location' => 'Køkken 2',
            'user_id' => 1

        );


        $response = $this->post('/api/courses', $body);
        $response->assertStatus(400);

    }
    public function testCreateReturns400IfMoreFieldsAreMissing()
    {

        $body = array(
              'name' => 'Madkursus',
            'description' => 'Lær at lave italiensk mad',
            /*'start' => '2019-04-10T08:00',
            'end' => '2019-04-10T20:00', */
            'location' => 'Køkken 2',
            'user_id' => 1

        );


        $response = $this->post('/api/courses', $body);
        $response->assertStatus(400);

    }

    // UPDATE
    public function testCanUpdateCourse(){
        $body = array(
            'name' => 'Madkursus',
            'description' => 'Lær at lave italiensk mad',
            'start' => '2019-04-10T08:00',
            'end' => '2019-04-10T20:00',
            'location' => 'Køkken 2',
            'user_id' => 1

        );
        $course =  Course::get()->first();

        $response = $this->put('/api/courses/' . $course->id, $body);
        $response->assertStatus(200);
    }


    public function testUpdateReturnsErrorIfFieldsAreMissing(){
        $body = array(
            'name' => 'Madkursus',
         /*   'description' => 'Lær at lave italiensk mad', */
            'start' => '2019-04-10T08:00',
      /*      'end' => '2019-04-10T20:00', */
            'location' => 'Køkken 2',
            'user_id' => 1

        );
        $course =  Course::get()->first();

        $response = $this->put('/api/courses/' . $course->id, $body);
        $response->assertStatus(400);
    }


    // DELETE

    public function testCanDeleteCourse(){
        $course =  Course::get()->last();

        $response = $this->delete('/api/courses/' . $course->id);
        $response->assertStatus(204);

    }

    public function DeleteReturnsErrorIfCourseDoesNotExist(){
        $course_id =  99;

        $response = $this->delete('/api/courses/' . $course_id);
        $response->assertStatus(400);

    }






}
