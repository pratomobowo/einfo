<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'action',
        'model_type',
        'model_id',
        'old_values',
        'new_values',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
    ];

    /**
     * Get the user that performed the activity.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get a description of the activity.
     */
    public function getDescriptionAttribute(): string
    {
        $modelName = class_basename($this->model_type);
        
        return match($this->action) {
            'create' => "created a new $modelName",
            'update' => "updated a $modelName",
            'delete' => "deleted a $modelName",
            default => "performed an action on a $modelName",
        };
    }
}
