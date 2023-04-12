<?php

namespace App\Traits;

trait MassAssignmentConcerns
{
    public static function createMany(array $data): array
    {
        $models = [];
        foreach ($data as $modelData) {
            $models[] = static::create($modelData);
        }
        return $models;
    }
}
