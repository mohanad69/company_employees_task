@extends('admin.layouts.master')
@section('content')
<h1 class="h3 mb-2 text-gray-800">Home Page</h1>
<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div><a href="{{route('companies.index')}}" class="text-xs font-weight-bold text-success text-uppercase mb-1">Companies</a></div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">15</div>
              </div>
              <div class="col-auto">
                <img src="{{asset('assets/img/office.png')}}" alt="">
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div><a href="{{route('employees.index')}}" class="text-xs font-weight-bold text-danger text-uppercase mb-1">Employees</a></div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">20</div>
              </div>
              <div class="col-auto">
                <img src="{{asset('assets/img/team.png')}}" alt="">
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection