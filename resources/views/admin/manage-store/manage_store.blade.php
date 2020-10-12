@extends('layouts.master')


@section('title')
    Project Xena
@endsection

@section('content')
{{-- Add Form --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Store</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/save-store" method="POST">

            {{ csrf_field() }}
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Store Code:</label>
                <input type="text" class="form-control" id="Scode" name="Scode" value="{{old("Scode")}}" style="text-transform:uppercase">
            </div>
            <div class="form-group">
                <label for="message-text" class="col-form-label">Store Name:</label>
                <input class="form-control" id="StoreName" name="StoreName" value="{{old("StoreName")}}" style="text-transform:uppercase">
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Dorm:</label>
                <input type="text" class="form-control" id="Dorm" name="Dorm" value="{{old("Dorm")}}" style="text-transform:uppercase">
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Area:</label>
                <input type="text" class="form-control" id="Area" name="Area" value="{{old("Area")}}" style="text-transform:uppercase">
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="StoreStatus" class="form-control">
                    <option value="Open">Open</option>
                    <option value="Close">Close</option>
                </select>
            </div>
        </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
      </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title"> STORE LIST</h4>
          {{-- this is for validation message --}}
          @if($errors->any())
            <div>
                <div class="alert alert-danger" role="alert">
                    @foreach($errors->all() as $error )
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </div>
            </div>
         @endif
          <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">Add New</button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="dataTable" class="table">
                <thead class=" text-primary">
                    <th width="10%">Store Code</th>
                    <th width="40%">Store Name</th>
                    <th width="10%">Dorm</th>
                    <th width="10%">Area</th>
                    <th width="2%">Status</th>
                    <th width="5%"></th>
                    {{-- <th width="5%"></th> --}}
                </thead>
                <tbody>
                    @foreach ( $StoreList as $RowStoreList)
                        <tr>
                            <td>{{$RowStoreList->Scode}}</td>
                            <td>{{$RowStoreList->StoreName}}</td>
                            <td>{{$RowStoreList->Dorm}}</td>
                            <td>{{$RowStoreList->Area}}</td>
                            <td>{{$RowStoreList->StoreStatus}}</td>
                            <td>
                                <a href="{{url('store-edit/'.$RowStoreList->id)}}" class="btn btn-warning"><center>📝</center></a>
                            </td>
                            {{-- <td>
                                <form action="" method="POST">
                                    {{ csrf_field() }}
                                    {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td> --}}
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
            $('#dataTable').DataTable();
        } );
    </script>
@endsection
