@extends('layouts.master')


@section('title')
    Project Xena
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title"> UPD MONITORING STATUS</h4>
        {{-- <a href="/export" class="btn btn-primary"> Export</a> --}}

        </div>
        <div class="card-body">
          <div class="table-responsive">
              @include('admin.dashboard.table')
          </div>
        </div>
      </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
         $(document).ready( function () {
            $('#DashboardView').DataTable();
        });
    </script>
@endsection
