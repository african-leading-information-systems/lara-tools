<?php
namespace Alis\LaraTools;

class AlisTools
{
    /**
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
}
