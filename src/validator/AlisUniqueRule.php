<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class AlisUniqueRule implements Rule
{
    private $table;
    private $field;
    private $ignore;

    /**
     * Create a new rule instance.
     *
     * @param $table
     * @param $field
     * @param $ignore
     */
    public function __construct(string $table, string $field, array $ignore = [])
    {
        //
        $this->table = $table;
        $this->field = $field;
        $this->ignore = $ignore;
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
        $query = DB::table($this->table)->where($this->field, $value);

        if (count($this->ignore)) {
            foreach ($this->ignore as $key => $value) {
                $query->where($key, $value);
            }
        }

        return  ! $query->where('invalid_y_n', 0)
            ->first();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute already exist.';
    }
}
