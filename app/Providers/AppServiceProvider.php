<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Support\ServiceProvider;
use App\Rules\ValidImageMime;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('unique_warning_test', function ($attribute, $value, $parameters, $validator) {
            $table = $parameters[0];
            $column = $parameters[1];
            $except = $parameters[2];

            $count = DB::table($table)
                ->where($column, $value)
                ->where('id', '<>', $except)
                ->count();

            if ($count > 0) {
                $validator->addWarning($attribute, 'Este valor ya existe en la base de datos');
            }

            return true;
        });

        Validator::extend('valid_image_mime', function ($attribute, $value, $parameters, $validator) {
            $rule = new ValidImageMime;
            return $rule->passes($attribute, $value);
        });

        Validator::replacer('valid_image_mime', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, $message);
        });
    }
}
