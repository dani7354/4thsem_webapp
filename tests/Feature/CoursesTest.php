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

    private $token = "c8Yo4FDNVxRwqg5bEe7kG62oAPWv59RohVkpjHZDiXqFSNy9RhK75oAZjk2F";
    private function addHeaders()
    {
        $this->withHeaders(
            [
                'Authorization' => 'Bearer ' . $this->token,
                'Accept' => 'application/json',
            ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */

    // READ
    public function testCanGetAllCourses()
    {
        $this->addHeaders();
        $response = $this->get('/api/courses/');
        $response->assertStatus(200);
    }
    public function testCanGetCourse()
    {
        $this->addHeaders();
        $course =  Course::get()->first();

        $response = $this->get('/api/courses/' . $course->id);
        $response->assertStatus(200);

    }
    public function testCanGetParticipantsForCourse()
    {
        $this->addHeaders();
        $course =  Course::get()->first();
        $response = $this->get('/api/courses/' . $course->id . '/participants');
        $response->assertStatus(200);

    }

    // CREATE

    public function testCreateCourse(){
        $this->addHeaders();

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
        $this->addHeaders();

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
        $this->addHeaders();
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
        $this->addHeaders();
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
        $this->addHeaders();
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
        $this->addHeaders();
        $course =  Course::get()->last();

        $response = $this->delete('/api/courses/' . $course->id);
        $response->assertStatus(204);

    }

    public function testDeleteReturnsErrorIfCourseDoesNotExist(){
        $this->addHeaders();
        $course_id =  1000;

        $response = $this->delete('/api/courses/' . $course_id);
        $response->assertStatus(404);

    }






}
