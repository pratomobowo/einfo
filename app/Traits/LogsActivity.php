<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    /**
     * Boot the trait for a model.
     */
    protected static function bootLogsActivity()
    {
        static::created(function (Model $model) {
            self::logActivity('create', $model);
        });

        static::updated(function (Model $model) {
            self::logActivity('update', $model, $model->getOriginal());
        });

        static::deleted(function (Model $model) {
            self::logActivity('delete', $model);
        });
    }

    /**
     * Log an activity for the model.
     */
    protected static function logActivity(string $action, Model $model, array $oldValues = [])
    {
        // Skip logging if we're in a database migration or seeding
        if (app()->runningInConsole() && !app()->environment('testing')) {
            return;
        }

        // Get only the attributes that were changed
        $newValues = $action === 'update' ? $model->getChanges() : $model->getAttributes();

        // Filter out attributes that shouldn't be logged
        if (method_exists($model, 'getActivityLogExcludedAttributes')) {
            $excludedAttributes = $model->getActivityLogExcludedAttributes();
            $newValues = array_diff_key($newValues, array_flip($excludedAttributes));
            
            if (!empty($oldValues)) {
                $oldValues = array_intersect_key($oldValues, $newValues);
            }
        }

        // Create the activity log
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'model_type' => get_class($model),
            'model_id' => $model->getKey(),
            'old_values' => !empty($oldValues) ? $oldValues : null,
            'new_values' => !empty($newValues) ? $newValues : null,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    /**
     * Get the attributes that should be excluded from the activity log.
     * Override this method in your model to customize.
     */
    public function getActivityLogExcludedAttributes(): array
    {
        return [
            'password',
            'remember_token',
            'created_at',
            'updated_at',
        ];
    }
} 