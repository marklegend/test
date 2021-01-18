<?php
include('../Template/header.php');
include('../Template/sidenav.php');
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    
    <section class="content-header">
      <h1>
        Dashboard
        <small>Welcome to Customers's Dashboard</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Customers</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    
  <!-- Main content -->
  <section class="content container-fluid">

  
  
            <div class="col-md-6 ">

            <div class="box box-info">
                <div class="box-header with-border">
                <h3 class="box-title">Customers</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <div class="table-responsive">
                    <table id="clientbirthday" class="table table-bordered table-striped no-margin">
                    <thead>
                    <tr>
                    <th>Client ID </th>
                    <th>Client Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
                </div>
            </div>
                
            </div>

         <div class="col-md-6 ">

            <div class="box box-info">
                <div class="box-header with-border">
                <h3 class="box-title">Unpaid Invoices</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <div class="table-responsive">
                    <table id="unpaidinv" class="table table-bordered table-striped no-margin">
                    <thead>
                    <tr>
                      <th>Client ID </th>       
                      <th>Client</th>
                      <th>Invoice No</th>
                      <th>Invoice Date</th>
                       
                    </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
                </div>
            </div>
                
            </div>


          


            <div class="col-md-6 ">

            <div class="box box-info">
                <div class="box-header with-border">
                <h3 class="box-title">Top 10 clients</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <div class="table-responsive">
                    <table id="topclients" class="table table-bordered table-striped no-margin">
                    <thead>
                    <tr>
                        <th>Frequency </th>
                        <th>Client</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
                </div>
            </div>
                
            </div>


            <div class="col-md-6 ">

            <div class="box box-info">
                <div class="box-header with-border">
                <h3 class="box-title">Top Operators</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <div class="table-responsive">
                    <table id="nopurchase" class="table table-bordered table-striped no-margin">
                    <thead>
                    <tr>
                        <th>Name </th>       
                        <th>username</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
                </div>
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
        url: "../api/dashboard/unpaid_read.php",
        dataType: 'json',
        success: function(data) {
            var response="";
            for(var unpaid in data){
                response += "<tr>"+
                "<td>"+data[unpaid].client_id+"</td>"+
                "<td>"+data[unpaid].client+"</td>"+
                "<td>"+data[unpaid].invoice_no+"</td>"+
                 "<td>"+data[unpaid].invoice_date+"</td>"+
                
                "</tr>";
            }
            $(response).appendTo($("#unpaidinv"));
        }
    });
  });
  $(document).ready(function(){
    $.ajax({
        type: "GET",
        url: "../api/dashboard/purchase_read.php",
        dataType: 'json',
        success: function(data) {
            var response="";
            for(var purchase in data){
                response += "<tr>"+
                "<td>"+data[purchase].nopurchase+"</td>"+
                "<td>"+data[purchase].month+"</td>"+
                               
                "</tr>";
            }
            $(response).appendTo($("#nopurchase"));
        }
    });
  });

  $(document).ready(function(){
    $.ajax({
        type: "GET",
        url: "../api/dashboard/birthday_read.php",
        dataType: 'json',
        success: function(data) {
            var response="";
            for(var birthday in data){
                response += "<tr>"+
                "<td>"+data[birthday].client_id+"</td>"+
                "<td>"+data[birthday].client_name+"</td>"+
                               
                "</tr>";
            }
            $(response).appendTo($("#clientbirthday"));
        }
    });
  });

  $(document).ready(function(){
    $.ajax({
        type: "GET",
        url: "../api/dashboard/minlvls_read.php",
        dataType: 'json',
        success: function(data) {
            var response="";
            for(var minlvl in data){
                response += "<tr>"+
                "<td>"+data[minlvl].supple+"</td>"+
                "<td>"+data[minlvl].supplier_info+"</td>"+
                "<td>"+data[minlvl].min_lvls+"</td>"+
                "<td>"+data[minlvl].curstock+"</td>"+
                               
                "</tr>";
            }
            $(response).appendTo($("#minlvls"));
        }
    });
  });

  $(document).ready(function(){
    $.ajax({
        type: "GET",
        url: "../api/dashboard/topclients_read.php",
        dataType: 'json',
        success: function(data) {
            var response="";
            for(var topclient in data){
                response += "<tr>"+
                "<td>"+data[topclient].freq+"</td>"+
                "<td>"+data[topclient].client+"</td>"+
                "</tr>";
            }
            $(response).appendTo($("#topclients"));
        }
    });
  });

  $(document).ready(function(){
    $.ajax({
        type: "GET",
        url: "../api/dashboard/contact_read.php",
        dataType: 'json',
        success: function(data) {
            var response="";
            for(var contact in data){
                response += "<tr>"+
                "<td>"+data[contact].client+"</td>"+
                "<td>"+data[contact].home+"</td>"+
                "<td>"+data[contact].work+"</td>"+
                "<td>"+data[contact].cell+"</td>"+
                "<td>"+data[contact].email+"</td>"+
                "</tr>";
            }
            $(response).appendTo($("#contacts"));
        }
    });
  });
  
</script>