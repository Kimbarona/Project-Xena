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
                  <h4 class="card-title"> Edit Roles For Registered User</h4>
                </div>
                <div class="card-body">
                   <div class="row">
                        <div class="col-md-12">
                            <form action="/role-register-update/{{ $users->id}}" method="POST">
                                {{ csrf_field() }}
                                {{method_field('PUT')}}
                                <div class="form-group">
                                    <label>Name</label>
                                <input type="text" class="form-control" name="username" value="{{ $users->name }}" >
                                </div>
                                <div class="form-group">
                                    <label>Give Role</label>
                                    <select name="usertype" class="form-control">
                                        <option value="">None</option>
                                        <option value="Admin">admin</option>
                                        <option value="User">User</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success">update</button>
                                <a href="/role-register" class="btn btn-danger">cancel</a>
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
