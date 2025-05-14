@extends('layouts.master')

@section('header', 'Database Overview')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Database Tables</h3>
        </div>
        <div class="card-body">
            @foreach($tablesInfo as $table)
                <div class="mb-4">
                    <h5>{{ $table['name'] }} <span class="badge badge-info">{{ $table['rows'] }} rows</span></h5>
                    <ul class="list-group">
                        @foreach($table['columns'] as $column)
                            <li class="list-group-item">{{ $column }}</li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
@endsection
