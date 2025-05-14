<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseController extends Controller
{
    public function showTables()
{
    $tables = DB::select('SHOW TABLES');
    $database = env('DB_DATABASE');

    $tableKey = "Tables_in_$database";

    $tablesInfo = [];

    foreach ($tables as $table) {
        $tableName = $table->$tableKey;

        $columns = Schema::getColumnListing($tableName);
        $rowCount = DB::table($tableName)->count();

        $tablesInfo[] = [
            'name' => $tableName,
            'columns' => $columns,
            'rows' => $rowCount,
        ];
    }

    return view('admin.database-overview', compact('tablesInfo'));
}
}
