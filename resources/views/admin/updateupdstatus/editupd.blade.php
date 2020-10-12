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
                  <h4 class="card-title"> Edit </h4>
                </div>
                <div class="card-body">
                   <div class="row">
                        <div class="col-md-12">
                            <form action="/Import-update/{{ $ImportData->id}}" method="POST">
                                {{ csrf_field() }}
                                {{method_field('PUT')}}
                                <div class="form-group">
                                    <label>Store Code</label>
                                    <input type="text" class="form-control" name="storecode" readonly value="{{ $ImportData->storecode }}" >
                                </div>
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="text" class="form-control" name="date" readonly value="{{ $ImportData->date }}" >
                                </div>
                                <div class="form-group">
                                    <label>Remarks</label>
                                    <select name="remarks" class="form-control">
                                        <option value=""></option>
                                        <option value="Dpd">Dpd</option>
                                        <option value="Loading">Loading</option>
                                        <option value="No Sales">No Sales</option>
                                        <option value="Regenerate">Regenerate</option>
                                        <option value="Recast">Recast</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-success">update</button>
                                <a href="/update-upd-status" class="btn btn-danger">cancel</a>
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
