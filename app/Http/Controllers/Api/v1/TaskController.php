<?php

namespace App\Http\Controllers\Api\v1;

use App\Facades\Reply;
use App\Helpers\Enums\Task\TaskStatuses;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\ChangeTaskStatusRequest;
use App\Http\Requests\Api\v1\TaskRequest;
use App\Http\Resources\v1\TaskCollection;
use App\Http\Resources\v1\TaskResource;
use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->filled('search')){
            $tasks = Task::search($request->search)
                ->query(function (Builder $query) use ($request) {
                    $query->filtered($request)->sorted($request);
                });
        }else{
            $tasks = Task::query()->filtered($request)->sorted($request);
        }

        $tasks = $tasks->paginate(10)->withQueryString();


        return new TaskCollection($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {
            $task = Task::create($data);

            if (array_key_exists('subtasks', $data)) {
                $task->subtasks()->attach($data['subtasks']);
            }

            DB::commit();

            return new TaskResource($task);

        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $task->load('subtasks');

        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        Gate::authorize('update', $task);

        $data = $request->validated();

        DB::beginTransaction();

        try {
            if ($request->status === TaskStatuses::Done->value && $task->subtasks->contains('status', TaskStatuses::Todo->value)) {
                return Reply::error('Some subtasks aren\'t completed');
            }

            $task->update($data);

            if (array_key_exists('subtasks', $data)) {
                $task->subtasks()->sync($data['subtasks']);
            }

            DB::commit();

            return new TaskResource($task);

        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    public function changeStatus(ChangeTaskStatusRequest $request, Task $task)
    {
        Gate::authorize('changeStatus', $task);

        if ($request->status === TaskStatuses::Done->value && $task->subtasks->contains('status', TaskStatuses::Todo->value)) {
            return Reply::error('Some subtasks aren\'t completed');
        }

        $task->status = $request->status;
        $task->save();

        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        Gate::authorize('delete', $task);

        if ($task->completed_at) {
            return Reply::error('You can\'t delete a completed task');
        }

        $task->delete();

        return Reply::noContent();
    }
}
