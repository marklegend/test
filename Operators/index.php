<?php
include('../Template/header.php');
include('../Template/sidenav.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Welcome to CustView's Dashboard</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Operator View</a></li>
        <li class="active">Operators</li>
      </ol>
    </section>
    
  <!-- Main content -->
  <section class="content container-fluid">

  <div class="row">
                <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Operators List</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="operators" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Password</th>
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
        processing: true,
        serverSide: true,
        type: "GET",
        url: "../api/operator/read.php",
        dataType: 'json',
        success: function(data) {
            var response="";
            for(var operators in data){
                response += "<tr>"+
                "<td>"+data[operators].name+"</td>"+
                "<td>"+data[operators].username+"</td>"+
                "<td>"+data[operators].password+"</td>"+
                "<td><a href='update.php?id="+data[operators].id+"'>Edit</a> | <a href='#' onClick=Remove('"+data[operators].id+"')>Remove</a></td>"+
                "</tr>";
            }
            $(response).appendTo($("#operators"));
        }
    });
  });
  function Remove(id){
    var result = confirm("Are you sure you want to delete the operator record?"); 
    if (result == true) { 
        $.ajax(
        {
            type: "POST",
            url: '../api/operator/delete.php',
            dataType: 'json',
            data: {
                id: id
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Removed user!");
                    window.location.href = '/test/Operators';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
  }
</script>