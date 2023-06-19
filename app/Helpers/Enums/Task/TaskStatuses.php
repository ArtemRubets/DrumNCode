<?php

namespace App\Helpers\Enums\Task;

enum TaskStatuses: string
{
    case Done = 'done';
    case Todo = 'todo';
}
