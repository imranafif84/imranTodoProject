@extends('layouts.header')

@section('content')
<div class="container">
    <h1>Top Completed Todo Users List</h1>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Total Completed</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@endsection
   
@section('script')
<script type="text/javascript">
  $(function () {
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('users.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'total', name: 'total'},
        ],
        "order": [[ 4, "desc" ]]
    });
    
  });
</script>
@endsection