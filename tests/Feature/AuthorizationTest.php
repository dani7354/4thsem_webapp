<?php

namespace Tests\Feature;

use App\Course;
use App\Role;
use Illuminate\Support\Str;
use Tests\TestCase;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorizationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {

        // testdata
        $this->testCourse = array(
            'name' => 'Madkursus',
            'description' => 'Lær at lave italiensk mad',
            'start' => '2019-04-10T08:00',
            'end' => '2019-04-10T20:00',
            'location' => 'Køkken 2',
        );

        parent::__construct($name, $data, $dataName);
    }


    private function addTokenAuth($header="")
    {
        $this->withHeaders(
            [
                'Authorization' => 'Bearer ' . $header,
                'Accept' => 'application/json',
            ]);
    }

    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function testAdminCanCreateCourse(){
        $user = User::find(2);
        $this->addTokenAuth($user->api_token);

        $body = $this->testCourse;
        $response = $this->post('/api/courses', $body);
        $response->assertStatus(201);
   }

   public function testForbiddenEmployeeCannotCreateCourse()
   {
       $user = User::find(1);
       $this->addTokenAuth($user->api_token);

       $body = $this->testCourse;
       $response = $this->post('/api/courses', $body);
       $response->assertStatus(403);

   }

   public function testUnauthorizedRequestCannotCreateCourse401()
   {
       $this->addTokenAuth();
       $body = $this->testCourse;
       $response = $this->post('/api/courses', $body);
       $response->assertStatus(401);
   }
}
