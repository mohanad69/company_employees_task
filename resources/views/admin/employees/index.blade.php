@extends('admin.layouts.master')
@section('content')
    <!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"> Employees Management </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header border-bottom-primary">
            <div class="row">
                <div class="col">
                    <h6 class="mt-2 font-weight-bold text-primary"> Employees </h6>
                </div>
                <div class="col-6"></div>
                <div class="col">
                    <a href="{{ route('employees.create') }}" class="btn btn-primary btn-icon-split btn-md ">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text"> Add Employee </span>
                    </a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label><strong>Company :</strong></label>
                    <select id='company' class="form-control" style="width: 100%">
                        <option selected value="0">Select Company</option>
                        @foreach ($companies as $company)
                            <option value="{{$company->id}}">{{$company->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered data-table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Company</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Company</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript">
    $(function () {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            // ajax: "{{ route('employees.datatable') }}",
            ajax: {
                url: "{{ route('employees.datatable') }}",
                data: function (d) {
                        d.company = $('#company').val(),
                        d.search = $('input[type="search"]').val()
                }
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'company', name: 'company'},
                {data: 'image', name: 'image'},
                {data: 'actions', name: 'actions'},
            ]
        });
        $('#company').change(function(){
            table.draw();
        });
    });
</script>