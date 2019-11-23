<?php
namespace Alis\LaraTools;

use Illuminate\Database\Eloquent\ModelNotFoundException;

trait AlisModel {
    /**
     * @param $query
     * @return mixed
     */
    public function scopeValid($query)
    {
        return $query->where('invalid_y_n', 0);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeInvalid($query)
    {
        return $query->where('invalid_y_n', 1);
    }

    /**
     * @param $query
     * @param $id
     * @return mixed
     */
    public function scopeAlisFindOrFail($query, $id)
    {
        $result = $query->whereKey($id)->valid()->first();

        if (! is_null($result)) {
            return $result;
        }

        throw (new ModelNotFoundException());
    }

    /**
     * @param $query
     * @param $column
     * @param $data
     * @return mixed
     */
    public function scopeWhereLike($query, $column, $data)
    {
        return $query->where($column, 'like', '%'.$data.'%');
    }
}
