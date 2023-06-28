<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Annotations as OA;

/**
 *
 * @OA\Info(
 *      version="1.0",
 *      title="DrumNCode Test API documentation",
 *      description="DrumNCode Test API documentation",
 *      @OA\Contact(
 *          email="artemrubets27@gmail.com"
 *      )
 * ),
 * @OA\PathItem(path="/api/v1")
 *
 * */

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
