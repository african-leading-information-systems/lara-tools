<?php

namespace Alis\LaraTools\Validator;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class AlisExistRule implements Rule
{
    private $table;
    private $field;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($table, $field)
    {
        $this->table = $table;
        $this->field = $field;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return !! DB::table($this->table)->where($this->field, $value)
            ->where('invalid_y_n', 0)
            ->first();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute not exist.';
    }
}
