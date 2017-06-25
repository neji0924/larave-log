<?php

namespace Neji0924\Log;

use Auth;
use Request;
use Neji0924\Log\Log;

trait Loggable
{
    public static function bootLoggable()
    {
        static::created(function ($model) {
            $model->adjust('created');
        });

        static::updating(function ($model) {
            $model->adjust('updating');
        });

        static::deleting(function ($model) {
            $model->adjust('deleting');
        });
    }

    public function logs()
    {
        return $this->morphMany(Log::class, 'loggable');
    }

    protected function adjust($method)
    {
        $diff = $this->getDiff($method);

        if (empty($diff['before']) && empty($diff['after'])) {
            return;
        }

        $log = new Log($diff);

        $log->ip = Request::ip();

        $log->user()->associate(Auth::user());

        if ($log->user_id === NULL) {
            $log->user_id = 0;
        }

        $this->logs()->save($log);
    }

    protected function getDiff($method)
    {
        $changed = $this->filterAttributes($this->getDirty());

        switch ($method) {
            case 'created':
                $diff = [
                    'before' => array_fill_keys(array_keys($changed), ''),
                    'after'  => $changed,
                ];
                break;

            case 'updating':
                $diff = [
                    'before' => array_intersect_key($this->fresh()->getAttributes(), $changed),
                    'after'  => $changed,
                ];
                break;

            case 'deleting':
                $diff = [
                    'before' => $changed,
                    'after'  => array_fill_keys(array_keys($changed), ''),
                ];
                break;
        }

        return $diff;
    }

    protected function filterAttributes($attributes)
    {
        return array_filter($attributes, function ($attribute) {
            return ! in_array($attribute, ['id', 'created_at', 'updated_at', 'deleted_at']);
        }, ARRAY_FILTER_USE_KEY);
    }
}
