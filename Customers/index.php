<?php
include('../Template/header.php');
include('../Template/sidenav.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Customer
        <small> Dashboard</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> CustView</a></li>
        <li class="active">Customers</li>
      </ol>
    </section>
    
  <!-- Main content -->
  <section class="content container-fluid">


        <div class="row">
                <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Customers List</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="customers" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                            <th>Customer ID</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Address</th>
                            <th>Password</th>
                            <th>Balance</th>
                            <th>Date Created</th>
                            <th>Actions</th>
                      </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <tfoot>
                      <tr>
                            <th>Customer ID</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Address</th>
                            <th>Password</th>
                            <th>Balance</th>
                            <th>Date Created</th>
                            <th>Actions</th>
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
        url: "../api/customer/read.php",
        dataType: 'json',
        success: function(data) {
            var response="";
            for(var customer in data){
                response += "<tr>"+
                "<td>"+data[customer].id+"</td>"+
                "<td>"+data[customer].name+"</td>"+
                "<td>"+data[customer].username+"</td>"+
                "<td>"+data[customer].address+"</td>"+
                "<td>"+data[customer].password+"</td>"+
                "<td>"+data[customer].balance+"</td>"+
                "<td>"+data[customer].date_created+"</td>"+
                "<td><a href='update.php?id="+data[customer].id+"'>Edit</a> | <a href='#' onClick=Remove('"+data[customer].id+"')>Remove</a></td>"+
                "</tr>";
            }
            $(response).appendTo($("#customers"));
        }
    });
  });
  function Remove(id){
    var result = confirm("Are you sure you want to Delete the customer Record?"); 
    if (result == true) { 
        $.ajax(
        {
            type: "POST",
            url: '../api/customer/delete.php',
            dataType: 'json',
            data: {
                id: id
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Removed customer!");
                    window.location.href = '/test/Customers';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
  }
</script>