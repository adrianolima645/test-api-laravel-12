<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait LogsActivity
{
    public static function bootLogsActivity() :void
    {
        static::created(function ($model) {
            Log::info('Created ' . class_basename($model), $model->toArray());
        });

        static::updated(function ($model) {
            Log::info("Updated " . class_basename($model), $model->getChanges());
        });

        static::deleted(function ($model) {
            Log::warning("Deleted " . class_basename($model), $model->toArray());
        });

        static::retrieved(function ($model) {
            Log::info("Retrieved " . class_basename($model), ['id' => $model->id]);
        });
    }
}
