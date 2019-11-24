<?php
namespace Alis\LaraTools;

class AlisTools
{
    /**
     * Method to translate array to string
     *
     * @param string $source
     * @param string $delimiter
     * @return array
     */
    public static function arrayToString(string $source, string $delimiter): array
    {
        return array_filter(array_unique(array_map(function ($item) {
            return trim($item);
        }, explode($delimiter, $source))), function ($item) {
            return !empty($item);
        });
    }

    /**
     * Method to combine each lines of array with other array
     *
     * @param array $attributes
     * @param array $fillData
     * @return array
     */
    public static function fillArray (array $attributes, array $fillData): array
    {
        $pivotData = array_fill(0, count($attributes), $fillData);
        $syncData  = array_combine($attributes, $pivotData);

        return $syncData;
    }
}
