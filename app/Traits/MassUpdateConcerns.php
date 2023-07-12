<?php

namespace App\Traits;

trait MassUpdateConcerns
{

    public static function updateMany(array $data): array
    {

        $models = [];
        $primaryKey = (new static())->getKeyName();

        foreach ($data as $modelData) {
            $id = $modelData[$primaryKey];
            $model = static::findOrFail($id);

            $changes = array_diff_assoc($modelData, $model->getAttributes());

            if (!empty($changes)) {
                $result = static::where($primaryKey, $id)->update($changes);

                if ($result) {
                    $model = static::findOrFail($id);
                    $models[] = $model;
                }

                // $model->fill($changes);
                // $model->save();
                // $models[] = $model;
            }
        }
        return $models;
    }


}
