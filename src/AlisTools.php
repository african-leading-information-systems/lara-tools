<?php
namespace Alis\LaraTools;

use Illuminate\Support\Facades\Storage;

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

    /**
     * Method to upload file on disk
     *
     * @param $file
     * @param string $disk
     * @param string $uploadPath
     * @param string|null $fileName
     * @param int|null $height
     * @param int|null $width
     * @return string
     */
    public static function handleUploadedFile($file, string $disk, string $uploadPath, string $fileName = null, int $height = null, int $width = null): string
    {
        if (is_null($fileName)) {
            $fileName = sha1(date('ymdhis').rand(1,10000));
        }

        $imgName = $fileName.'.'.$file->getClientOriginalExtension();

        $file->storeAs($uploadPath, $imgName, $disk);

        return $imgName;
    }
    /**
     * Delete file on storage
     *
     * @param string $disk
     * @param string $filePath
     * @return bool
     */
    public function removeUploadedFile(string $disk, string $filePath): bool
    {
        return Storage::disk($disk)->delete($filePath);
    }
}
