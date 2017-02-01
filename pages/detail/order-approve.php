<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="../action/member-order-input.php">
  <font size="">
 

  <div class="col-sm-12">
  <div class="form-group">
    <label class="control-label col-md-5" for="first-name">Order No.
    </label>
    <div class="col-md-4 font-hijau">
      <?php 
      date_default_timezone_set('Asia/Jakarta');
      $bln=date("m");
      $thn=date("Y");

      $order_no=mysql_fetch_array(mysql_query("select no_order from t4t_order where no_order like '%T4T-E/$bln/$thn%' ORDER BY no desc limit 1"));

      $ex_order=explode("/", $order_no[0]);
      $gen_order=$ex_order[0]+1;
      echo $gen_order."/T4T-E/".$bln."/".$thn;
       ?>
       <input type="hidden" name="no_order" value="<?php echo $gen_order."/T4T-E/".$bln."/".$thn; ?>" >
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-5 " for="first-name">Company Name <span class="required"></span>
    </label>
    <div class="col-md-4 font-hijau">
      <?php 
      $kode=$_SESSION['kode'];
      $comp_name=mysql_fetch_array(mysql_query("select nama from t4t_partisipan where id='$kode'"));
      echo $comp_name[0];
      ?>
      <input type="hidden" name="comp" value="<?php echo $comp_name[0]; ?>" >
    </div>
  </div>

  <div class="col-md-2"></div>
  <div class="form-group col-md-8" align="center">
    <table id="table-container">
      <thead>
      <tr>
        <th rowspan="2"></th>
        <th colspan="5" width="50%"><center>Container Size</center></th>
        <th rowspan="2"><center>Planned Stuffing Date</center></th>
      </tr>
      <tr>
        <th>20'</th>
        <th>40'</th>
        <th>40' HC</th>
        <th>45'</th>
        <th>60'</th>
      </tr>
      </thead>
      <tbody>
        <td><input type="" name="qty" value="QTY" class="form-control" readonly=""></td>
        <td><input type="number" name="n201" class="form-control" min="1"></td>
        <td><input type="number" name="n401" class="form-control" min="1"></td>
        <td><input type="number" name="n40hc1" class="form-control" min="1"></td>
        <td><input type="number" name="n451" class="form-control" min="1"></td>
        <td><input type="number" name="n601" class="form-control" min="1"></td>
        <td><input type="text" name="tgl1" class="form-control" id="datepicker" required=""></td>
        <td><a class="btn btn-danger" onclick="deleteRow1(this)" value="delete" id="delete1" data-toggle="" data-placement="right" title="Delete"><i class="fa fa-times"></i></a></td>

      </tbody>
    </table>
    <div align="right">
   
    <a class="btn btn-success" onclick="addField()"><i class="fa fa-plus"></i> Add</a>
    <input type="hidden" id="forinput" name="forinput" value="1" >

    </div>
  </div>
  <div class="col-md-2"></div>

  <div class="form-group">
    <label class="control-label col-md-5" for="first-name">Type of Product <span class="required"></span>
    </label>
    <div class="col-md-4">
      <input type="text" class="form-control" name="type_prod" id="">
      
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-5" for="first-name">Wood Species <span class="required"></span>
    </label>
    <div class="col-md-4">
      <ul class="to_do">
      <?php 
      $wood=mysql_query("select * from t4t_pohonen");
      while ($data_pohon=mysql_fetch_array($wood)) {
        
       ?>
          <li>
              <p><input type="checkbox" class="flat" name="item[]" value="<?php echo $data_pohon[0] ?>"> <?php echo $data_pohon[1] ?> </p>
          </li>
      <?php 
      }
       ?>    
      </ul>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-5" for="first-name"> Quantity Hang Tags Requested <span class="required"></span>
    </label>
    <div class="col-md-2">
      <input type="number" class="form-control" min="1" name="tags" >
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-5" for="first-name">Other Requests <span class="required"></span>
    </label>
    <div class="col-md-4">
      <table>
        <thead>
          <th>Request</th>
          <th></th>
          <th>Qty</th>
        </thead>
        <tbody>
        <?php 
        $other=mysql_query("select * from t4t_req");
        while ($data_other=mysql_fetch_array($other)) {
          
         ?>
          <tr>
            <td><?php echo $data_other[1] ?></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td width="80px"><input type="number" class="form-control" name="req<?php echo $data_other[0] ?>" min="0"></td>
          </tr>
        <?php 
         }
         ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- <div class="form-group">
    <label class="control-label col-md-5" for="first-name">Destination City <span class="required"></span>
    </label>
    <div class="col-md-4">
      <input type="text" class="form-control col-md-7 col-xs-12" name="destination" >
    </div>
  </div> -->

  <div class="form-group">
    <label class="control-label col-md-5" for="first-name">PIC <span class="required"></span>
    </label>
    <div class="col-md-4 font-hijau">
      <?php 
      $pic_name=mysql_fetch_array(mysql_query("select pic from t4t_partisipan where id='$kode'"));
       if ($pic_name[0]=="") {
         echo "none";
       }else{
       echo $pic_name[0];
       }
       ?>
       <input type="hidden" name="pic" value="<?php echo $pic_name[0]; ?>">
    </div>
  </div>
  


  <div class="ln_solid"></div>
  <div class="form-group">
    <div class="col-md-5 col-md-offset-5">
      <a href="?<?php echo paramEncrypt('hal=member-order-input-choose-cont')?>" class="btn btn-primary">Reset</a>
      <button type="submit" class="btn btn-success">Submit</button>
    </div>
  </div>
  </div>

  </font>
</form>