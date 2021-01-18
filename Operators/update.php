<?php
include('../Template/header.php');
include('../Template/sidenav.php');
?>  
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        operator
        <small>Welcome to CustView's Operator Dashboard</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> CustView</a></li>
        <li class="active">Update Operator</li>
      </ol>
    </section>
    
  <!-- Main content -->
  <section class="content container-fluid">
         <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Update user</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="exampleInputName1">Name</label>
                          <input type="text" class="form-control" id="name" placeholder="Enter Name" maxlength="30" required>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">Username/Email</label>
                          <input type="username" class="form-control" id="username" placeholder="Enter Username/email" maxlength="40" pattern="/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/" required >
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input type="password" class="form-control" id="password" placeholder="Password" required>
                        </div>
                       
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="updateOperator()" value="Update"></input>
                        <a href="/test/operators" class="btn btn-primary">Back</a>
                      </div>
                    </form>
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
            url: "../api/operator/read_single.php?id=<?php echo $_GET['id']; ?>",
            dataType: 'json',
            success: function(data) {
                $('#name').val(data['name']);
                $('#username').val(data['username']);
                $('#password').val(data['password']);
      
            },
            error: function (result) {
                console.log(result);
            },
        });
    });
    function updateOperator(){
        $.ajax(
        {
            type: "POST",
            url: '../api/operator/update.php',
            dataType: 'json',
            data: {
                id: <?php echo $_GET['id']; ?>,
                name: $("#name").val(),
                username: $("#username").val(),        
                password: $("#password").val(),
             
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Updated operator!");
                    window.location.href = '/test/Operators';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>