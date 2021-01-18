<?php
include('../Template/header.php');
include('../Template/sidenav.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Invoices
        <small> Dashboard</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> CustView</a></li>
        <li class="active">Invoices</li>
      </ol>
    </section>
    
  <!-- Main content -->
  <section class="content container-fluid">

             <div class="row">
                <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Invoices List</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="Invoices" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>Invoice ID</th>
                        <th>Customer ID</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Paid Date</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <tfoot>
                      <tr>
                       <th>Invoice ID</th>
                        <th>Customer ID</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Paid Date</th>
                        <th>Action</th>
                      </tr>
                      </tfoot>
                    </table>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
            </div>
            </section>
            <?php
            include('../Template/footer.php');
          ?>

<!-- page script -->
<script>
  $(document).ready(function(){
    $.ajax({
        type: "GET",
        url: "../api/invoice/read.php",
        dataType: 'json',
        success: function(data) {
            var response="";
            for(var invoice in data){
                response += "<tr>"+
                "<td>"+data[invoice].id+"</td>"+
                "<td>"+data[invoice].cust_id+"</td>"+
                "<td>"+data[invoice].description+"</td>"+
                "<td>"+data[invoice].amount+"</td>"+
                "<td>"+data[invoice].paid_date+"</td>"+
                "<td><a href='update.php?id="+data[invoice].id+"'>Edit</a> | <a href='#' onClick=Remove('"+data[invoice].id+"')>Remove</a></td>"+
                "</tr>";
            }
            $(response).appendTo($("#Invoices"));
        }
    });
  });
  function Remove(id){
    var result = confirm("Are you sure you want to Delete the Invoice Record?"); 
    if (result == true) { 
        $.ajax(
        {
            type: "POST",
            url: '../api/invoice/delete.php',
            dataType: 'json',
            data: {
                id: id
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Removed Invoice!");
                    window.location.href = '/test/invoices';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
  }
</script>