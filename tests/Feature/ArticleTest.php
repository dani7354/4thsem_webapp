<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Article;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
  private $token = "c8Yo4FDNVxRwqg5bEe7kG62oAPWv59RohVkpjHZDiXqFSNy9RhK75oAZjk2F";

    /**
     *
     */
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
    public function testCanGetAllArticle()
    {
        $this->addHeaders();
        $response = $this->get('/api/articles/');
        $response->assertStatus(200);
    }
    public function testCanGetArticle()
    {
        $this->addHeaders();
        $article =  Article::get()->first();


        $response = $this->get('/api/articles/' . $article->id);
        $response->assertStatus(200);
    }


    // CREATE

    public function testCreateArticle(){
        $this->addHeaders();

        $body = array(
            'title' => 'Jonna har sidste arbejdsdag',
            'content' => '...Nu skal hun nemlig på efterløn',
            'tags' => '#tag',
        );


        $response = $this->post('/api/articles', $body);
        $response->assertStatus(201);
    }

    public function testCreateReturns400IfFieldIsMissing()
    {
        $this->addHeaders();

        $body = array(
       /*     'title' => 'Jonna har sidste arbejdsdag',*/
            'content' => '...Nu skal hun nemlig på efterløn',
            'tags' => '#tag',


        );


        $response = $this->post('/api/articles', $body);
        $response->assertStatus(400);

    }
    public function testCreateReturns400IfMoreFieldsAreMissing()
    {
        $this->addHeaders();

        $body = array(
            'title' => 'Jonna har sidste arbejdsdag',
           /* 'content' => '...Nu skal hun nemlig på efterløn', */
            'tags' => '#tag',
      /*      'user_id' => 1 */

        );


        $response = $this->post('/api/articles', $body);
        $response->assertStatus(400);

    }

    // UPDATE
    public function testCanUpdateArticle(){
        $this->addHeaders();
        $body = array(
            'title' => 'Ja mojn do',
            'content' => '...Nu skal hun nemlig på efterløn',
            'tags' => '#tag',
            'user_id' => 1

        );
        $article =  Article::get()->first();

        $response = $this->put('/api/articles/' . $article->id, $body);
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
        $article =  Article::get()->first();

        $response = $this->put('/api/articles/' . $article->id, $body);
        $response->assertStatus(400);
    }


    // DELETE

    public function testCanDeleteCourse(){
        $this->addHeaders();
        $article =  Article::get()->last();

        $response = $this->delete('/api/articles/' . $article->id);
        $response->assertStatus(204);

    }

    public function testDeleteReturnsErrorIfCourseDoesNotExist(){
        $this->addHeaders();
        $article_id =  1000;

        $response = $this->delete('/api/articles/' . $article_id);
        $response->assertStatus(404);

    }

}
