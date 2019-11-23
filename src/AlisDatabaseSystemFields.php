<?php
namespace Alis\LaraTools;

use Illuminate\Database\Schema\Blueprint;

class AlisDatabaseSystemFields
{
    /**
     * @param Blueprint $table
     * @param int $precision
     */
    public static function generateSystemFields(Blueprint $table, $precision = 0)
    {
        $table->bigInteger('creator')->index()->unsigned();
        $table->timestamp('creation_date', $precision);
        $table->bigInteger('lastkeyer')->index()->unsigned();
        $table->timestamp('lastkey_date', $precision);
        $table->boolean('invalid_y_n')->default(0);
    }
}
