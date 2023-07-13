<?php

namespace App\Traits;
use Illuminate\Support\Collection;

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
    public static function updateMany(array $newData, array $bbddData): array
    {
        $to_create = [];
        $to_delete = [];
        $models = [];
        foreach ($newData as $modelData) {
            if (isset($modelData['id'])){
                $model = static::find($modelData['id']);
            }
            else $model = false;

            if ($model) {
                $model->update($modelData);
                $models[] = $model;

            } else {
                $to_create[] = $modelData;
            }
        }

        $to_delete = array_diff(array_column($bbddData, 'id'), array_column($newData, 'id'));

        return [
            'models' => $models,
            'absent' => $to_create,
            'missing' => $to_delete
        ];
    }
    public static function disableMany(array $ids, string $field = 'enable'): void
    {
        static::whereIn('id', $ids)->update([$field  => false]);
    }

}
