@extends('layouts.master')


@section('title')
    Project Xena
@endsection
{{-- <link href="../../classes/assets/css/bootstrap.min.css" rel="stylesheet" />
<link href="../../classes/assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" /> --}}

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title"> Edit Store</h4>
                </div>
                <div class="card-body">
                   <div class="row">
                        <div class="col-md-12">
                            <form action="/store-update/{{ $StoreList->id}}" method="POST">
                                {{ csrf_field() }}
                                {{method_field('PUT')}}
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Store Code:</label>
                                    <input type="text" class="form-control" id="Scode" name="Scode" value="{{$StoreList->Scode}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Store Name:</label>
                                    <input class="form-control" id="StoreName" name="StoreName" value="{{$StoreList->StoreName}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Dorm:</label>
                                    <input type="text" class="form-control" id="Dorm" name="Dorm" value="{{$StoreList->Dorm}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Area:</label>
                                    <input type="text" class="form-control" id="Area" name="Area" value="{{$StoreList->Area}}">
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="StoreStatus" class="form-control">
                                        <option value="Open">Open</option>
                                        <option value="Closed">Closed</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success">update</button>
                                <a href="/manage-store" class="btn btn-danger">cancel</a>
                            </form>
                        </div>
                   </div>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection




