<script src="../js/datepicker/datepicker/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("input.datepicker").datepicker({
                dateFormat : "dd-mm-yy",
                changeMonth : true,
                changeYear : true
            });
        });
    </script>
    <script type="text/javascript">
function addField (argument) {
        var myTable = document.getElementById("table-container");
        var currentIndex = myTable.rows.length;
        var currentRow = myTable.insertRow(-1);

        //untuk looping berapa kali sesuai panjang table
        var forinput = document.getElementById("forinput");
        forinput.setAttribute("value", currentIndex);
      
        var qty = document.createElement("input");
        qty.setAttribute("value", "QTY");
        qty.setAttribute("readonly", "");
        qty.setAttribute("class", "form-control");
        qty.setAttribute("name", "qty" + currentIndex);

        var n20 = document.createElement("input");
        n20.setAttribute("type", "number");
        n20.setAttribute("min", "0");
        n20.setAttribute("class", "form-control");
        n20.setAttribute("name", "n20" + currentIndex);

        var n40 = document.createElement("input");
        n40.setAttribute("type", "number");
        n40.setAttribute("min", "0");
        n40.setAttribute("class", "form-control");
        n40.setAttribute("name", "n40" + currentIndex);

        var n40hc = document.createElement("input");
        n40hc.setAttribute("type", "number");
        n40hc.setAttribute("min", "0");
        n40hc.setAttribute("class", "form-control");
        n40hc.setAttribute("name", "n40hc" + currentIndex);

        var n45 = document.createElement("input");
        n45.setAttribute("type", "number");
        n45.setAttribute("min", "0");
        n45.setAttribute("class", "form-control");
        n45.setAttribute("name", "n45" + currentIndex);

        var n60 = document.createElement("input");
        n60.setAttribute("type", "number");
        n60.setAttribute("min", "0");
        n60.setAttribute("class", "form-control");
        n60.setAttribute("name", "n60" + currentIndex);
        
        var tgl = document.createElement("input");
        tgl.setAttribute("type", "text");
        tgl.setAttribute("required", "");
        tgl.setAttribute("id", "datepicker");
        tgl.setAttribute("class", "form-control");
        tgl.setAttribute("name", "tgl" + currentIndex);

        var deleterow = document.createElement("a");
        deleterow.setAttribute("id", "delete"+currentIndex);
        deleterow.setAttribute("value", "delete");
        deleterow.setAttribute("data-toggle", "tooltip");
        deleterow.setAttribute("data-placement", "right");
        deleterow.setAttribute("title", "Delete");
        deleterow.setAttribute("class", "btn btn-danger");
        deleterow.setAttribute("onclick", "deleteRow"+currentIndex+"(this)");
        deleterow.innerHTML='<i class="fa fa-times"></i>';

       // ------------ //
        currentCell = currentRow.insertCell(-1);
        currentCell.appendChild(qty);

        var currentCell = currentRow.insertCell(-1);
        currentCell.appendChild(n20);

        var currentCell = currentRow.insertCell(-1);
        currentCell.appendChild(n40);

        var currentCell = currentRow.insertCell(-1);
        currentCell.appendChild(n40hc);

        var currentCell = currentRow.insertCell(-1);
        currentCell.appendChild(n45);

        var currentCell = currentRow.insertCell(-1);
        currentCell.appendChild(n60);
        
        var currentCell = currentRow.insertCell(-1);
        currentCell.appendChild(tgl);

        currentCell = currentRow.insertCell(-1);
        currentCell.appendChild(deleterow);
    }

    function deleteRow (r){
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("table-container").deleteRow(i);
}
<?php
  for($i=0;$i<100;$i++)
  {
?>

  function deleteRow<?php echo $i ?> (r){
      var i = r.parentNode.parentNode.rowIndex;
      document.getElementById("table-container").deleteRow(i);
  }
<?php  
}
?>

</script>

<script>
    $(document).on("focus", "#datepicker", function(){
        $(this).datepicker();

    });
</script>