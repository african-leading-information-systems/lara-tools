<?php
namespace Alis\LaraTools;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class AlisDatabaseSystemFields
{
    /**
     * @param Blueprint $table
     * @param int $precision
     */
    public static function generateSystemFields(Blueprint $table, $precision = 0)
    {
        $table->bigInteger('creator')->index()->unsigned();
        $table->timestamp('creation_date', $precision)->default(DB::raw('CURRENT_TIMESTAMP'));
        $table->bigInteger('lastkeyer')->index()->unsigned();
        $table->timestamp('lastkey_date', $precision)->default(DB::raw('CURRENT_TIMESTAMP'));
        $table->boolean('invalid_y_n')->default(0);
    }

    /**
     * @param $id
     * @return array
     */
    public static function insertData ($id) : array
    {
        return [
            'creator' => $id,
            'creation_date' => now(),
            'lastkeyer' => $id,
            'lastkey_date' => now()
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public static function actionData ($id) : array
    {
        return [
            'lastkeyer' => $id,
            'lastkey_date' => now()
        ];
    }
}
