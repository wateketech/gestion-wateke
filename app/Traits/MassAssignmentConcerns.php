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
    public static function updateMany(array $data): array
    {
        $to_create = [];
        $to_delete = [];
        $models = [];
        foreach ($data as $modelData) {
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
        // static::whereNotIn('id', collect($data)->pluck('id'))->update('enable', false);

        return [
            'models' => $models,
            'to_create' => $to_create,
            'to_delete' => $to_delete
        ];
    }
}
