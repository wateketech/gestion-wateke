<?php

namespace App\Rules;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Validation\Rule;

class UniqueWarning implements Rule
{
    protected $table;
    protected $column;
    protected $ignoreId;
    protected $message;
    protected $value;

    public function __construct($table, $column, $ignoreId = null, $message)
    {
        $this->table = $table;
        $this->column = $column;
        $this->ignoreId = $ignoreId;
        $this->message = $message;
    }
    public function passes($attribute, $value)
    {
        //$query = DB::table($this->table)
        //    ->where($this->column, '=', $value);

        //if ($this->ignoreId !== null) {
        //    $query->where('id', '!=', $this->ignoreId);
        //}

        $validator = Validator::make([], []);
        $validator->addError($this->column, 'El valor del campo ' . $this->column . ' ya existe en la base de datos.');
        $this->validator = $validator;

        //return ($query->count() == 0);
        return false;
    }

    public function message()
    {
        return $this->message;
    }
    public function after($validator)
    {
        dd('hola');
        $value = $validator->getData()[$this->column];

        $query = DB::table($this->table)
            ->where($this->column, '=', $value);

        if ($this->ignoreId !== null) {
            $query->where('id', '!=', $this->ignoreId);
        }

        if ($query->count() > 0) {
            $validator->errors()->add($this->column, 'Advertencia: El valor del campo ' . $this->column . ' ya existe en la base de datos.');
        }
    }

}
