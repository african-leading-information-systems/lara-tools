<?php
namespace Alis\LaraTools;

use Illuminate\Database\Eloquent\ModelNotFoundException;

trait AlisModel {
    /**
     * get Valid record
     *
     * @param $query
     * @return mixed
     */
    public function scopeValid($query)
    {
        return $query->where('invalid_y_n', 0);
    }

    /**
     * Get Invalid record
     *
     * @param $query
     * @return mixed
     */
    public function scopeInvalid($query)
    {
        return $query->where('invalid_y_n', 1);
    }

    /**
     * Find record with a id parameter or fail if record don't exist
     *
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
     * Use whereLike (AND) method to search record on databases
     *
     * @param $query
     * @param $column
     * @param $data
     * @return mixed
     */
    public function scopeWhereLike($query, $column, $data)
    {
        return $query->where($column, 'like', '%'.$data.'%');
    }

	 /**
     * Use whereLike (OR) method to search record on databases with
     *
     * @param $query
     * @param $column
     * @param $data
     * @return mixed
     */
	public function scopeOrWhereLike($query, $column, $data)
    {
        return $query->orWhere($column, 'like', '%'.$data.'%');
    }

    /**
     * Alis firstOrCreate method, use this method to find or create new record
     *
     * @param $query
     * @param array $attributes
     * @param array $values
     * @param $author
     * @return mixed
     */
    public function scopeAlisFirstOrCreate($query, array $attributes, array $values, $author)
    {
        $attributes = array_merge($attributes, ['invalid_y_n' => 0]);

        $values = array_merge($values, AlisDatabaseSystemFields::insertData($author));

        return $query->firstOrCreate($attributes, $values);
    }
}
