<?php

namespace App\Observers\Api\v1;

use App\Helpers\Enums\Task\TaskStatuses;
use App\Models\Task;
use Carbon\Carbon;

class TaskObserver
{
    /**
     * Handle the Task "creating" event.
     */
    public function creating(Task $task): void
    {
        match ($task->status){
            TaskStatuses::Done->value => $task->completed_at = Carbon::now(),
            TaskStatuses::Todo->value => $task->completed_at = null,
        };

        $task->user_id = auth()->user()->id;
    }

    /**
     * Handle the Task "created" event.
     */
    public function created(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "updating" event.
     */
    public function updating(Task $task): void
    {
        match ($task->status){
            TaskStatuses::Done->value => $task->completed_at = Carbon::now(),
            TaskStatuses::Todo->value => $task->completed_at = null,
        };

        $task->user_id = auth()->user()->id;
    }

    /**
     * Handle the Task "updated" event.
     */
    public function updated(Task $task): void
    {

    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "restored" event.
     */
    public function restored(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "force deleted" event.
     */
    public function forceDeleted(Task $task): void
    {
        //
    }
}
