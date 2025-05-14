@extends('layouts.master')
@section('header', 'Database Viewer')

@section('content')
<div class="card">
    <div class="card-body">
        <label for="tableSelect">Select Table:</label>
        <select id="tableSelect" class="form-control mb-3">
            <option disabled selected>Select a table</option>
            @foreach($tableNames as $table)
                <option value="{{ $table }}">{{ $table }}</option>
            @endforeach
        </select>

        <div id="tableContainer">
            <div class="alert alert-info">Table data will appear here...</div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('tableSelect').addEventListener('change', function () {
        let table = this.value;
        fetch(`/admin/db-viewer/fetch?table=${table}`)
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('tableContainer');
                if (data.error) {
                    container.innerHTML = `<div class="alert alert-danger">${data.error}</div>`;
                    return;
                }

                let html = '<div class="table-responsive"><table class="table table-bordered table-striped"><thead><tr>';
                data.columns.forEach(col => {
                    html += `<th>${col}</th>`;
                });
                html += '</tr></thead><tbody>';

                if (data.rows.length === 0) {
                    html += `<tr><td colspan="${data.columns.length}" class="text-center">No data available</td></tr>`;
                } else {
                    data.rows.forEach(row => {
                        html += '<tr>';
                        data.columns.forEach(col => {
                            html += `<td>${row[col] ?? ''}</td>`;
                        });
                        html += '</tr>';
                    });
                }

                html += '</tbody></table></div>';
                container.innerHTML = html;
            })
            .catch(error => {
                console.error(error);
                document.getElementById('tableContainer').innerHTML =
                    `<div class="alert alert-danger">Error fetching data.</div>`;
            });
    });
</script>
@endsection
