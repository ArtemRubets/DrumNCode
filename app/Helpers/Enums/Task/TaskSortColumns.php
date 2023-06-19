<?php

namespace App\Helpers\Enums\Task;

enum TaskSortColumns: string
{
    case createdAt = 'created_at';
    case completedAt = 'completed_at';
    case priority = 'priority';
}
