@extends('layouts.master')


@section('title')
    Project Xena
@endsection

@section('content')

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Customer</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/save-customer" method="POST">

            {{ csrf_field() }}
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Name:</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="message-text" class="col-form-label">Address:</label>
                <input class="form-control" id="address" name="address">
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone">
            </div>
        </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>


<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title"> Customer List
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add New</button>
          </h4>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="datatable" class="table table-striped">
                <thead class=" text-primary">
                    <th>Id</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th width="5%">Edit</th>
                    <th width="5%">Delete</th>
                </thead>
                <tbody>
                    @foreach ( $customer as $data)

                        <tr>
                            <td>{{$data->id}}</td>
                            <td>{{$data->name}}</td>
                            <td>{{$data->address}}</td>
                            <td>{{$data->phone}}</td>
                            <td>
                                <a href="{{url('customer-edit/'.$data->id)}}" class="btn btn-success">Edit</a>
                            </td>
                            <td>
                                <form action="/customer-delete/{{ $data->id }}" method="POST">
                                    {{ csrf_field() }}
                                    {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready( function () {
    $('#datatable').DataTable();
} );
</script>
@endsection
