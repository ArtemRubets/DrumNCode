<?php

namespace App\Models;

use App\Helpers\Enums\Task\TaskSortColumns;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Searchable;

class Task extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'status',
        'priority',
        'title',
        'description'
    ];

    protected $casts = ['completed_at' => 'datetime'];

    public function subtasks(): BelongsToMany
    {
        return $this->belongsToMany(self::class, 'tasks_subtasks', 'task_id', 'subtask_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFiltered(Builder $query, Request $request): void
    {
        $query->when($request->status, function (Builder $query) use ($request) {
            $query->where('status', $request->status);
        })
            ->when($request->priority_from, function (Builder $query) use ($request) {
                $query->where('priority', '>=', $request->priority_from);
            })
            ->when($request->priority_to, function (Builder $query) use ($request) {
                $query->where('priority', '<=', $request->priority_to);
            });
    }

    public function scopeSorted(Builder $query, Request $request): void
    {
        $query->when($request->sort_by && TaskSortColumns::tryFrom($request->sort_by), function (Builder $query) use ($request) {
            $sortOrder = $request->sort_order ?? 'asc';

            $query->orderBy($request->sort_by, $sortOrder);
        });
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    #[SearchUsingFullText(['title'])]
    public function toSearchableArray(): array
    {
        return [
            'title' => $this->title,
        ];
    }


}
