
<h4>
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
</h4>
<!-- Modal add-->
<div class="modal fade" id="exampleModaladd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Remarks</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="/save-remarks" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Store Code</label>
                    <input type="text" class="form-control" name="storecode" value="" readonly id="storecode" >
                </div>
                <div class="form-group">
                    <label>Date</label>
                    <input type="text" class="form-control" name="date" value="" readonly id="date" >
                </div>
                <div class="form-group">
                    <label>Remarks</label>
                    <select name="remarks" class="form-control" required>
                        <option value=""></option>
                        <option value="Dpd">Dpd</option>
                        <option value="Loading">Loading</option>
                        <option value="No Sales">No Sales</option>
                        <option value="Regenerate">Regenerate</option>
                        <option value="Recast">Recast</option>
                    </select>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>

<table id="TableReports" class="table">
    <thead class=" text-primary">
        <th width="5%"><font color='grey' size='4px' >Imported Date</font></th>
        <th width="5%"><font color='grey' size='4px'>Store Code</font></th>
        <th width="10%"><font color='grey'size='4px' >Store Name</font></th>
        <th width="5%"><font color='grey' size='4px'>Dorm</font></th>
        <th width="5%"><font color='grey' size='4px'>Area</font></th>
        <?php
                $cregdates = count($regdates);

                for ($i=0; $i < $cregdates; $i++) : ?>

                    <th  width="2%" style='border:1px solid #fff'><font color='grey' size='2px'><?php echo $regdates[$i]; ?></font></th>

                <?php endfor;
        ?>
    </thead>
    <tbody>
        <?php

        $ctr = 0;
        foreach ($stores as $k => $v) :
            ?>
                <tr>
                    <?php
                    $date = $v->created_at;
                        $f_date = strtotime($date);
                        $new_date = date('m-d-Y ', $f_date);
                    // dd($new_date);
                        ?>
                        <td><?php echo $new_date ?></td>
                        <?php
                    ?>
                    <td>{{$v->storecode}}</td>
                    <td>{{$v->StoreName}}</td>
                    <td>{{$v->Dorm}}</td>
                    <td>{{$v->Area}}</td>

                    <?php

                        $cregdates = count($regdates);


                        for ($i=0; $i < $cregdates; $i++) :
                            $d = $regdates[$i];
                            $status = $entries[$ctr][$d]['status'];
                            // $countMissingUpd = $entries[$ctr][$d]['CountMissingUpd'];

                                if($status == 'available'){
                                    ?>
                                        <td style='border:1px solid #fff' bgcolor="green"><font size='1.5px' color='white'><center>✓</center></font></td>
                                    <?php
                                }else{
                                    ?>
                                        <td style='border:1px solid #fff' bgcolor="black"><font size='2px' color='white'><center>
                                        <input type="text" style="background-color:Black; height:0px; color:rgb(0, 0, 0);border:0px " class="form-control"  readonly  value="<?php echo $regdates[$i];?>">

                                        <?php
                                            if($entries[$ctr][$d]['remarks']!=""){
                                                echo $entries[$ctr][$d]['remarks'];
                                                $Id= $entries[$ctr][$d]['id'];
                                                ?>
                                                     <input type="hidden" class="RemarksHolder" id="RemarksHolder<?php echo $entries[$ctr][$d]['id'];?>" value="<?php echo $entries[$ctr][$d]['remarks']; ?>">

                                                <?php
                                            }else{
                                                echo "";
                                                ?>
                                                    <input type="hidden" class="RemarksHolder" id="RemarksHolder<?php echo $entries[$ctr][$d]['id'];?>" value="">
                                                <?php
                                            }


                                        ?>
                                        </center></font>
                                    </td>
                                    <?php
                                    }
                        endfor;

                    ?>
                </tr>

            <?php

            $ctr++;
        endforeach; ?>

    </tbody>
</table>
<!-- Button trigger modal add -->
<button type="button" class="btn btn-primary" id="btnmodal" data-toggle="modal" data-target="#exampleModaladd"></button>

<!-- Button trigger modal update -->
<button type="button" class="btn btn-primary" id="btnmodalupdate" data-toggle="modal" data-target="#exampleModalupdate"></button>


  <!-- Modal update-->
  <div class="modal fade" id="exampleModalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Remarks</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="/update-remarks" id="FormUpdate" method="POST">
                {{ csrf_field() }}
                {{method_field('PUT')}}
                <div class="form-group">
                    <input type="hidden" class="form-control" name="id" value="" readonly id="id" >
                </div>
                <div class="form-group">
                    <label>Remarks</label>
                    <select name="remarks" class="form-control" required>
                        <option value=""></option>
                        <option value="Dpd">Dpd</option>
                        <option value="Loading">Loading</option>
                        <option value="No Sales">No Sales</option>
                        <option value="Regenerate">Regenerate</option>
                        <option value="Recast">Recast</option>
                    </select>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit"  id="btnid" value="" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>


<script>
    $(document).ready(function(){
        $("#btnmodal").hide();
        $("#btnmodalupdate").hide();


    });

    // function myFunction(date,code, id){
    //     var date = date;
    //     var storecode = code;
    //     var s = $("#RemarksHolder"+id).val();


    //     if(s==null){
    //         // alert("wala");
    //         // $("#addremarks"+code).show();
    //         $("#btnmodal").click();
    //         $("#storecode").val(storecode);
    //         $("#date").val(date);

    //     }
    //     else{
    //         $("#btnmodalupdate").click();
    //         $("#btnid").val(id);
    //         // $("#addremarks"+id).show();
    //         $("#id").val(id);

    //     }


    // }


</script>
