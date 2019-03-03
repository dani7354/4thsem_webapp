<?php

namespace Tests\Feature;

use App\Deadline;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeadlineTest extends TestCase
{
    // TODO: test CRUD
    // READ
    public function testCanGetAllDeadlines()
    {
        $response = $this->get('/api/deadlines/');
        $response->assertStatus(200);
    }
    public function testCanGetDeadline()
    {
        $deadline =  Deadline::get()->first();

        $response = $this->get('/api/deadlines/' . $deadline->id);
        $response->assertStatus(200);

    }


    // CREATE

    public function testCreateDeadline(){

        $body = array(
            'name' => 'Maden skal være klar',
            'description' => 'Jørgen og Jonna står for at lave mad denne gang',
            'date' => '2019-04-10T20:00'
        );


        $response = $this->post('/api/deadlines', $body);
        $response->assertStatus(201);
    }

    public function testCreateReturns400IfFieldIsMissing()
    {

        $body = array(
         /*   'name' => 'Maden skal være klar',*/
            'description' => 'Jørgen og Jonna står for at lave mad denne gang',
            'date' => '2019-04-10T20:00'
        );


        $response = $this->post('/api/deadlines', $body);
        $response->assertStatus(400);

    }
    public function testCreateReturns400IfMoreFieldsAreMissing()
    {

        $body = array(
            /*   'name' => 'Maden skal være klar',*/
            'description' => 'Jørgen og Jonna står for at lave mad denne gang'/*,
            'date' => '2019-04-10T20:00' */
        );


        $response = $this->post('/api/deadlines', $body);
        $response->assertStatus(400);

    }

    // UPDATE
    public function testCanUpdateDeadline(){
        $body = array(
            'name' => 'Maden skal være klar',
            'description' => 'Jørgen og Bent står for at lave mad denne gang',
            'date' => '2019-06-10T20:00'
        );
        $deadline =  deadline::get()->first();

        $response = $this->put('/api/deadlines/' . $deadline->id, $body);
        $response->assertStatus(200);
    }


    public function testUpdateReturnsErrorIfFieldsAreMissing(){
        $body = array(
            /*   'name' => 'Maden skal være klar',*/
            'description' => 'Jørgen og Jonna står for at lave mad denne gang'/*,
            'date' => '2019-04-10T20:00' */
        );
        $deadline =  deadline::get()->first();

        $response = $this->put('/api/deadlines/' . $deadline->id, $body);
        $response->assertStatus(400);
    }


    // DELETE

    public function testCanDeletedeadline(){
        $deadline =  Deadline::get()->last();

        $response = $this->delete('/api/deadlines/' . $deadline->id);
        $response->assertStatus(204);

    }

    public function testDeleteReturnsErrorIfDeadlineDoesNotExist(){
        $deadline_id =  1000;

        $response = $this->delete('/api/deadlines/' . $deadline_id);
        $response->assertStatus(404);

    }


}
