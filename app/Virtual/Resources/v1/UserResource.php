<?php

namespace App\Virtual\Resources\v1;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="UserResourсe",
 *     description="User Resourсe",
 *     @OA\Xml(
 *         name="UserResource"
 *     )
 * )
 *
 * @OA\Property(property="id", type="integer", example=1),
 * @OA\Property(property="name", type="string", example="Prof. Sincere Funk DVM"),
 * @OA\Property(property="email", type="string", example="zabernathy@example.net"),
 */

class UserResource
{

}
