<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseController extends Controller
{
public function index()
{
    $database = env('DB_DATABASE');
    $tables = DB::select('SHOW TABLES');
    $key = "Tables_in_$database";
    $tableNames = collect($tables)->pluck($key)->toArray();

    return view('admin.db-viewer', compact('tableNames'));
}

public function fetchTable(Request $request)
{
    $table = $request->table;

    if (!Schema::hasTable($table)) {
        return response()->json(['error' => 'Table not found.'], 404);
    }

    $columns = Schema::getColumnListing($table);
    $rows = DB::table($table)->limit(100)->get(); // Limit for performance

    return response()->json([
        'columns' => $columns,
        'rows' => $rows
    ]);
}
}
