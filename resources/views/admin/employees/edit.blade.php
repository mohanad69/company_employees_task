@extends('admin.layouts.master')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"> Employees </h1>
    <!-- DataTales Example -->
    <div class="col-12">
        <!-- Illustrations -->
        <div class="card shadow mb-4">
            <div class="card-header border-bottom-primary">
                <div class="row">
                    <h6 class="mt-2 font-weight-bold text-primary"> Edit Employee </h6>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name"> <strong> Name:</strong></label>
                        <input required type="text" value="{{ old('name', $employee->name) }}" class="form-control"
                            placeholder="Mohanad Magdy" name="name">
                        @error('name')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email"> <strong> Email:</strong></label>
                        <input required type="email" value="{{ old('email', $employee->email) }}" class="form-control"
                            placeholder="mohanad.ghalab@gmail.com" name="email">
                        @error('email')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address"> <strong> Address:</strong></label>
                        <input required type="text" value="{{ old('address', $employee->address) }}" class="form-control"
                            placeholder="Nasr City - Cairo - Egypt" name="address">
                        @error('address')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password"> <strong> Password:</strong></label>
                        <input type="password" value="{{ old('password') }}" class="form-control"
                            placeholder="********" name="password">
                        @error('password')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Company:</label>
                        <select style="height:40px !important" name="company_id" class="form-control">
                            <option disabled selected disabled> Select Company</option>
                            @foreach ($companies as $company)
                                <option @if($employee->company_id == $company->id) selected @endif value="{{$company->id}}">{{$company->name}}</option>
                            @endforeach
                        </select>
                        @error('company_id')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="title"> <strong> Image:</strong></label>
                        <input type="file" class="form-control" name="image">
                        @error('image')
                            <span style="color:red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-danger"> Submit </button>
                        <a href="{{ route('employees.index') }}" class="btn btn-primary btn-icon-split ">
                            <span class="text"> Back </span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
