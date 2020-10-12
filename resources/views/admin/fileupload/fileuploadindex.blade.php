@extends('layouts.master')


@section('title')
    Project Xena
@endsection

@section('content')

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Upload File Here</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/import-file" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="file" name="file" required>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-success now-ui-icons arrows-1_cloud-upload-94" value="Upload">
            </div>
        </form>
      </div>
    </div>
  </div>
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title"> UPLOADED FILE</h4>
          <br>
            @if(count($errors) > 0)
            <div class="alert alert-danger">
                    Upload Validation Error<br><br>
                <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                        <button type="button" class="close" data-dismiss="alert">×</button>
                </ul>
            </div>
            @endif

         @if($message = Session::get('success'))
         <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>
                 <strong>{{ $message }}</strong>
         </div>
         @endif

          <button type="button" class="btn btn-secondary now-ui-icons arrows-1_cloud-upload-94" data-toggle="modal" data-target="#exampleModal"> Upload New File</button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="dataTable" class="table">
                <thead class=" text-primary">
                    <th width="25%">Uploaded Date</th>
                    <th width="20%">Store Code</th>
                    <th width="10">Date</th>
                </thead>
                <tbody>
                    @foreach ( $imports as $importdata)
                        <tr>
                            <td>
                                <?php
                                    $date = $importdata->created_at;
                                    $f_date = strtotime($date);
                                    $new_date = date('m-d-Y ', $f_date);
                                    echo $new_date;
                                ?>
                            </td>
                            <td>{{$importdata->storecode}}</td>
                            <td><font size='2px' color='green'><b>{{$importdata->date}}</b></font></td>
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
