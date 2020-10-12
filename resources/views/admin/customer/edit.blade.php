@extends('layouts.master')


@section('title')
    Project Xena
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title"> Edit Customer</h4>
                </div>
                <div class="card-body">
                   <div class="row">
                        <div class="col-md-12">
                            <form action="/customer-update/{{ $customer->id}}" method="POST">
                                {{ csrf_field() }}
                                {{method_field('PUT')}}
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $customer->name }}" >
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="address" value="{{ $customer->address }}" >
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" name="phone" value="{{ $customer->phone }}" >
                                </div>

                                <button type="submit" class="btn btn-success">update</button>
                                <a href="/customer" class="btn btn-danger">cancel</a>
                            </form>
                        </div>
                   </div>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
