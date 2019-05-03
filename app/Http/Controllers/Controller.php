<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /**
     * @license Apache 2.0
     */
    /**
     * @OA\Info(
     *     description="Danrevi API",
     *     version="1.0.0",
     *     title="Danrevi API",
     *     @OA\Contact(
     *         email="dape@edu.eal.dk"
     *     )
     * )
     */
    /**
     * @OA\Tag(
     *     name="danrevi",
     *     description="danrevi api",
     * )
     * @OA\Server(
     *     description="",
     *     url="/api"
     * )
     * @OA\ExternalDocumentation(
     *     description="Find out more about Swagger",
     *     url="http://swagger.io"
     * )
     */
}
