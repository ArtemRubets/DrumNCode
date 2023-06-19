<?php

namespace Tests\Feature\Api\v1;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    private $apiVersion;
    private $domain;

    public function setUp(): void
    {
        $this->refreshApplication();

        $this->apiVersion = config('app.api_prefix');
        $this->domain = config('app.url');

        parent::setUp();
    }

    /**
     * A basic feature test example.
     */
    public function test_index(): void
    {

        $response = $this->getJson(route('tasks.index'));

        $response->assertStatus(200)
            ->assertJsonFragment([
                "links" => [
                    "first" => "{$this->domain}/{$this->apiVersion}/tasks?page=1",
                    "last" => "{$this->domain}/{$this->apiVersion}/tasks?page=2",
                    "prev" => null,
                    "next" => "{$this->domain}/{$this->apiVersion}/tasks?page=2"
                ],
                "meta" => [
                    "current_page" => 1,
                    "from" => 1,
                    "last_page" => 2,
                    "links" => [
                        [
                            "url" => null,
                            "label" => "&laquo; Previous",
                            "active" => false
                        ],
                        [
                            "url" => "{$this->domain}/{$this->apiVersion}/tasks?page=1",
                            "label" => "1",
                            "active" => true
                        ],
                        [
                            "url" => "{$this->domain}/{$this->apiVersion}/tasks?page=2",
                            "label" => "2",
                            "active" => false
                        ],
                        [
                            "url" => "{$this->domain}/{$this->apiVersion}/tasks?page=2",
                            "label" => "Next &raquo;",
                            "active" => false
                        ]
                    ],
                    "path" => "{$this->domain}/{$this->apiVersion}/tasks",
                    "per_page" => 10,
                    "to" => 10,
                    "total" => 20
                ]
            ])
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'status',
                        'title',
                        'description',
                        'priority',
                        'subtasks' => [
                            '*' => [
                                'id',
                                'status',
                                'title',
                                'description',
                                'priority',
                                'subtasks',
                                'user' => [
                                    'id',
                                    'name',
                                    'email',
                                ],
                                'completed_at',
                                'created_at',
                                'updated_at',
                            ],
                        ],
                        'user' => [
                            'id',
                            'name',
                            'email',
                        ],
                        'completed_at',
                        'created_at',
                        'updated_at',
                    ],
                ]
            ]);
    }

    public function test_index_with_filters_and_sort(): void
    {
        $user = User::factory()->create();

        $tasks = Task::factory()->for($user)->createManyQuietly([
            [
                'status' => 'todo',
                'title' => 'full text search',
                'priority' => 5,
            ],
            [
                'status' => 'todo',
                'title' => 'full search alala',
                'priority' => 6,
            ]
        ]);

        $response = $this->getJson(route('tasks.index', [
            'priority_from' => 5,
            'priority_to' => 6,
//            'search' => 'full text search', //Not Working in tests
            'status' => 'todo',
            'sort_by' => 'priority',
            'sort_order' => 'desc'
        ]))->json();

        $this->assertGreaterThanOrEqual(count($tasks), $response['data']);

        foreach ($response['data'] as $task) {
            $this->assertGreaterThanOrEqual(5, $task['priority']);
            $this->assertLessThanOrEqual(6, $task['priority']);
            $this->assertEquals('todo', $task['status']);
        }

        $priorities = array_column($response['data'], 'priority');
        $sorted = $priorities;
        array_multisort($sorted, SORT_DESC);

        $this->assertEquals($priorities, $sorted);

    }
}
