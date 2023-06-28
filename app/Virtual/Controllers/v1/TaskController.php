<?php

namespace App\Virtual\Controllers\v1;

use OpenApi\Annotations as OA;

/**
 *
 * @OA\Get(
 *      path="/api/v1/tasks/{id}",
 *      tags={"Tasks"},
 *      summary="Get task information",
 *      description="Returns task data",
 *      @OA\Parameter(
 *          name="id",
 *          description="Task id",
 *          required=true,
 *          example=1,
 *          in="path",
 *          @OA\Schema(
 *              type="integer"
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *          @OA\JsonContent(
 *              @OA\Property(property="data", type="object",
 *                  ref="#/components/schemas/TaskResource"
 *              ),
 *              @OA\Examples(example="With Subtasks", summary="With Subtasks", value={
 *                   "data": {
 *                      "id": 1,
 *                      "status": "todo",
 *                      "title": "Task title",
 *                      "description": "Task description",
 *                      "priority": 5,
 *                      "user": {
 *                          "id": 1,
 *                          "name": "Mr. Arvel Emard II",
 *                          "email": "williamson.noble@example.com",
 *                      },
 *                      "subtasks": {
 *                          {
 *                              "id": 2,
 *                              "status": "done",
 *                              "title": "Subtask 1",
 *                              "description": "Task description",
 *                              "priority": 3,
 *                              "user": {
 *                                  "id": 1,
 *                                  "name": "Mr. Arvel Emard II",
 *                                  "email": "williamson.noble@example.com",
 *                              },
 *                              "subtasks": {},
 *                              "completed_at": "2023-06-16T06:02:52.000000Z",
 *                              "created_at": "2023-06-16T06:02:52.000000Z",
 *                              "updated_at": "2023-06-16T06:02:52.000000Z",
 *                          },
 *                          {
 *                              "id": 3,
 *                              "status": "todo",
 *                              "title": "Subtask 2",
 *                              "description": "Task description",
 *                              "priority": 2,
 *                              "user": {
 *                                  "id": 1,
 *                                  "name": "Mr. Arvel Emard II",
 *                                  "email": "williamson.noble@example.com",
 *                              },
 *                              "subtasks": {},
 *                              "completed_at": "2023-06-16T06:02:52.000000Z",
 *                              "created_at": "2023-06-16T06:02:52.000000Z",
 *                              "updated_at": "2023-06-16T06:02:52.000000Z",
 *                          }
 *                      },
 *                      "completed_at": "2023-06-16T06:02:52.000000Z",
 *                      "created_at": "2023-06-16T06:02:52.000000Z",
 *                      "updated_at": "2023-06-16T06:02:52.000000Z",
 *                  }
 *              }),
 *              @OA\Examples(example="Without Subtasks", summary="Without Subtasks", value={
 *                   "data": {
 *                      "id": 1,
 *                      "status": "todo",
 *                      "title": "Task title",
 *                      "description": "Task description",
 *                      "priority": 5,
 *                      "user": {
 *                          "id": 1,
 *                          "name": "Mr. Arvel Emard II",
 *                          "email": "williamson.noble@example.com",
 *                      },
 *                      "subtasks": {},
 *                      "completed_at": "2023-06-16T06:02:52.000000Z",
 *                      "created_at": "2023-06-16T06:02:52.000000Z",
 *                      "updated_at": "2023-06-16T06:02:52.000000Z",
 *                  }
 *              })
 *          )
 *       ),
 *      @OA\Response(
 *          response=404,
 *          description="Not found"
 *      ),
 * )
 */

class TaskController
{




}
