<table class="table table-bordered">
    <tbody>
        <tr align="center" style="boder;border-bottom:3pt solid #22d4ae;"> 
            <td>#</td>
            <td>BrCode</td>
            <td>BrName</td>
            <td>Type Off Error</td>
           
           
        </tr>
        <?php 
            $i=1;
            foreach($detail as $row){?>
        <tr align="center">
            <td><?= $i++;?></td>
            <td><?= $row->brCode;?></td>
            <td><?= $row->shortcode;?></td>
            <td style="color:red">
            <?php 
            if($checking>=1){
                echo "បញ្ជូនទិន្នន័យមិនបានជោគជ័យ សូមធ្វើការUpload ម្ដង់ទៀត!";
            }else{
                echo "ទិន្នន័យមិនទាន់ធ្វើការ Upload សូមទាក់ទង់សាខាដើម្បីអោយគាត់ធ្វើការUpload CMR";
            }
            ?></td>          
        </tr>
        <?php }?>
    </tbody>
</table>