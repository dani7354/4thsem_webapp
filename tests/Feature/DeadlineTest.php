<?php

namespace Tests\Feature;

use App\Deadline;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeadlineTest extends TestCase
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
    // READ
    public function testCanGetAllDeadlines()
    {
        $this->addHeaders();

        $response = $this->get('/api/deadlines/');
        $response->assertStatus(200);
    }
    public function testCanGetDeadline()
    {
        $this->addHeaders();
        $deadline =  Deadline::get()->first();

        $response = $this->get('/api/deadlines/' . $deadline->id);
        $response->assertStatus(200);

    }


    // CREATE

    public function testCreateDeadline(){
        $this->addHeaders();

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
        $this->addHeaders();

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
        $this->addHeaders();

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
        $this->addHeaders();
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
        $this->addHeaders();
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
        $this->addHeaders();
        $deadline =  Deadline::get()->last();

        $response = $this->delete('/api/deadlines/' . $deadline->id);
        $response->assertStatus(204);

    }

    public function testDeleteReturnsErrorIfDeadlineDoesNotExist(){
        $this->addHeaders();
        $deadline_id =  1000;

        $response = $this->delete('/api/deadlines/' . $deadline_id);
        $response->assertStatus(404);

    }


}
