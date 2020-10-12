@extends('layouts.master')


@section('title')
    Project Xena
@endsection

@section('content')



  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">UPD History</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <p>
                @if (!count($Min))
                    {{ 'No Data Found!' }}
                @else
                    <h5>Fresh Morning!</h5>
                    <br>
                    <p><b>Transaction Date as of :</b> <?php foreach ($Min as $key => $value) {
                        $min = $Min[$key]->date;
                        $max = $Max[$key]->date;
                    }?><?php
                    $originalMinDate = $min;
                    $newMinDate = date("F d", strtotime($originalMinDate));
                    echo $newMinDate;
                    ?> -
                    <?php
                        $originalMaxDate = $max;
                        $newMaxDate = date("F d, Y", strtotime($originalMaxDate));
                        echo $newMaxDate
                    ?></p>
                    <br>

                    <?php

                    $ctr = 0;
                        $cregdates = count($regdates);

                        foreach ($stores as $k => $v){
                                    $StoreNme = $stores[$k]->StoreName;
                                    $S_Area = $stores[$k]->Area;
                            for ($i=0; $i < $cregdates; $i++){
                                $date = $regdates[$i];
                                $status = $entries[$ctr][$date]['status'];
                                $remarks = $entries[$ctr][$date]['remarks'];

                                // $entryCode = $upddata[$k]->storecode;

                                if($status == 'available'){

                                }else{
                                    if($remarks == 'Loading' || $remarks=='Un-Zreading' || $remarks=='Manual' || $remarks=='Store-closed'){

                                    }else{
                                        ?>
                                            <b>Area <?php echo $S_Area ?></b><br>
                                            <?php echo $StoreNme ?> : <?php
                                                $origDate = $date;
                                                $nDate = date("F d", strtotime($origDate));
                                                echo $nDate
                                            ?> - <font color='red'><b><?php echo $remarks ?></b></font><br>
                                            {{-- CROSSING  (January 3 Di process date) (jan 15)<br>
                                            CITICENTER (BUYMAXX PANDAN) (January 6) --}}

                                            <br><br>

                                        <?php
                                    }
                                }
                            }
                            $ctr++;

                        }
                    ?>
                @endif
            </p>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title"> UPD MONITORING REPORTS</h4><br>
          <?php
        //   var_dump($totdpd);

          ?>
             <!-- Button trigger modal -->
             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                View History
            </button>

            @if (!count($countEmptydate))
          <ul class="list-group list-group-horizontal-lg ">
              <li class="list-group-item " id="sample"><font size='3px'>Total Missing Dates :</font> <span class="badge badge-danger">0</span></li>
              <li class="list-group-item "><font size='3px'>Unprocess-date :</font> <span class="badge badge-danger">0</span></li>
              <li class="list-group-item "><font size='3px'>Loading :</font> <span class="badge badge-danger">0</span></li>
              <li class="list-group-item "><font size='3px'>Regenerate :</font> <span class="badge badge-danger">0</span></li>
              <li class="list-group-item "><font size='3px'>Un-Zreading :</font> <span class="badge badge-danger">0</span></li>
              <li class="list-group-item "><font size='3px'>Manual :</font> <span class="badge badge-danger">0</span></li>
              <li class="list-group-item "><font size='3px'>Store Closed :</font> <span class="badge badge-danger">0</span></li>
          </ul>
          @else
              <ul class="list-group list-group-horizontal-lg">
                  <li class="list-group-item " id="sample"><font size='3px'>Total Missing Dates :</font> <span class="badge badge-danger">{{ count($countEmptydate) }}</span></li>
                  <li class="list-group-item "><font size='3px'>Unprocess-date:</font> <span class="badge badge-danger">{{ count($Totdpd) }}</span></li>
                  <li class="list-group-item "><font size='3px'>Loading :</font> <span class="badge badge-danger">{{ count($TotLoading) }}</span></li>
                  <li class="list-group-item "><font size='3px'>Regenerate :</font> <span class="badge badge-danger">{{ count($TotRegenerate) }}</span></li>
                  <li class="list-group-item "><font size='3px'>Un-Zreading :</font> <span class="badge badge-danger">{{ count($TotRecast) }}</span></li>
                  <li class="list-group-item "><font size='3px'>Manual :</font> <span class="badge badge-danger">{{ count($TotNoSales) }}</span></li>
                  <li class="list-group-item "><font size='3px'>Store Closed :</font> <span class="badge badge-danger">{{ count($TotNoStoreclosed) }}</span></li>
              </ul>
          @endif



          <br>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            @include('admin.reports.usertable')
          </div>
        </div>
      </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#TableReports').DataTable({
                paging: false,
                dom: 'Bfrtip',
                buttons: [
                    'excel'
                ]
            });
        });
    </script>
@endsection
