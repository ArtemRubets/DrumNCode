<?php

namespace App\Virtual\Resources\v1;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="TaskResourсe",
 *      description="Task Resourсe",
 *      @OA\Xml(
 *          name="TaskResource"
 *      )
 *  )
 *
 * @OA\Property(property="id", type="integer", example=1),
 * @OA\Property(property="status", type="string", enum={"todo", "done"}, example="todo"),
 * @OA\Property(property="title", type="string", example="Task Title"),
 * @OA\Property(property="description", type="string", example="Task description"),
 * @OA\Property(property="priority", type="integer", example=5),
 * @OA\Property(property="user", type="object", ref="#/components/schemas/UserResource"),
 * @OA\Property(property="subtasks", type="array",
 *      @OA\Items(
 *          @OA\Property(property="id", type="integer", example=2),
 *          @OA\Property(property="status", type="string", enum={"todo", "done"}, example="done"),
 *          @OA\Property(property="title", type="string", example="Subtask 1"),
 *          @OA\Property(property="description", type="string", example="Subtask 1"),
 *          @OA\Property(property="priority", type="integer", example=2),
 *          @OA\Property(property="user", type="object", ref="#/components/schemas/UserResource"),
 *          @OA\Property(property="subtasks", type="array",
 *              @OA\Items(), example={}
 *          ),
 *          @OA\Property(property="completed_at", type="string", format="date-time", example="2023-06-16T06:02:52.000000Z"),
 *          @OA\Property(property="created_at", type="string", format="date-time", example="2023-06-16T06:02:52.000000Z"),
 *          @OA\Property(property="updated_at", type="string", format="date-time", example="2023-06-16T06:02:52.000000Z"),
 *      )),
 * @OA\Property(property="completed_at", type="string", format="date-time", example="2023-06-16T06:02:52.000000Z"),
 * @OA\Property(property="created_at", type="string", format="date-time", example="2023-06-16T06:02:52.000000Z"),
 * @OA\Property(property="updated_at", type="string", format="date-time", example="2023-06-16T06:02:52.000000Z"),
 *
 *
 */
class TaskResource
{

}
