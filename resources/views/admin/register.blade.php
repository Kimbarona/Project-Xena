@extends('layouts.master')


@section('title')
    Project Xena
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title"> Registered Roles</h4>
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
            <table id='datatable' class="table">
                <thead class=" text-primary">
                    <th>User Id</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>User Type</th>
                    <th width="5%">Edit</th>
                    <th width="5%">Delete</th>
                </thead>
                <tbody>
                    @foreach ($users as $rowusers )
                        <tr>
                            <td>{{ $rowusers->id }}</td>
                            <td>{{ $rowusers->name }}</td>
                            <td>{{ $rowusers->phone }}</td>
                            <td>{{ $rowusers->email }}</td>
                            <td>{{ $rowusers->usertype }}</td>
                            <td>
                                <a href="/role-edit/{{ $rowusers->id }}" class="btn btn-success">Edit</a>
                            </td>
                            <td>
                                <form action="/role-delete/{{ $rowusers->id }}" method="POST">
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
   });
</script>
@endsection
