
<table id="DashboardView" class="table">
    <thead class=" text-primary">
        <th width="5%">Store Code</th>
        <th width="10%">Store Name</th>
        <th width="5%">Dorm</th>
        <th width="5%">Area</th>
        <?php
                $cregdates = count($regdates);

                for ($i=0; $i < $cregdates; $i++) : ?>

                    <th  width="2%" style='border:1px solid #fff'><font color='' size='2px'><?php echo $regdates[$i]; ?></font></th>

                <?php endfor;
        ?>
    </thead>
    <tbody>
            {{-- <input type="button"  id="target" value="Click me" /> --}}
        <?php

        $ctr = 0;
        foreach ($stores as $k => $v) :
            ?>
                <tr>
                    <td>{{$v->storecode}}</td>
                    <td>{{$v->StoreName}}</td>
                    <td>{{$v->Dorm}}</td>
                    <td>{{$v->Area}}</td>
                    <?php

                        $cregdates = count($regdates);

                        for ($i=0; $i < $cregdates; $i++) :
                            $d = $regdates[$i];
                            $status = $entries[$ctr][$d]['status'];
                            // $Remarks = $entries[$ctr][$d]['remarks'];
                                // dd($Remarks);

                                if($status == 'available'){
                                    ?>
                                        <td  style='border:1px solid #fff' bgcolor="green"><font size='1.5px' color='white' ><center>✅</center></font></td>
                                    <?php

                                }else{
                                    ?>
                                        <td  style='border:1px solid #fff' bgcolor="black"><font size='1.5px' color='white'><center>❌</center></font></td>
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






