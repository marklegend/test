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
              <li><a href="#"><i class="fa fa-dashboard"></i> CustView</a></li>
              <li class="active">Update customer info</li>
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
                            <h3 class="box-title">Update customer</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form role="form">
                            <div class="box-body">
                                <div class="form-group">
                                <label for="exampleInputName1">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter customer Name" maxlength="20"  required>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputName1" >Username</label>
                                <input type="text"  id="username" class="form-control" placeholder="Enter customer Surname" maxlength="20"  required >
                            </div>

                            <div class="form-group">
                                <label  for="exampleInputName1" >Address</label>
                               
                                <textarea  id="address" class="form-control" rows="4"  maxlength="60" placeholder="Enter address"></textarea>
                            </div>


                            <div class="form-group">
                                <label  for="exampleInputPassword1" >Password</label>
                                <input type="password" id="paasword" class="form-control" maxlength="5"  placeholder="Enter postal code" >
                            </div>


                            <div class="form-group">
                                <label  for="exampleInputName1" >Balance</label>
                                <input type="number"  id="balance" class="form-control" placeholder="Enter cellphone no" maxlength="18"  required pattern="[+-]?([0-9]*[.])?[0-9]+" >
                            </div>

                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                          <input type="button" class="btn btn-primary" onClick="updateCustomer()" value="Submit"></input>
                          <a href="/test/Customers" class="btn btn-info">Back</a>
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
            url: "../api/customer/read_single.php?id=<?php echo $_GET['id']; ?>",
            dataType: 'json',
            success: function(data) {
               
                $('#name').val(data['name']),
                $('#username').val(data['username']),
                $('#address').val(data['address']),
                $('#password').val(data['password']),
                $('#balance').val(data['balance'])
  
            },
            error: function (result) {
                console.log(result);
            },
        });
    });
    function updateCustomer(){
        $.ajax(
        {
            type: "POST",
            url: '../api/customer/update.php',
            dataType: 'json',
            data: {
                id: <?php echo $_GET['id']; ?>,
                name: $("#name").val(),
                username: $("#username").val(),
                address: $("#address").val(),
                password: $('#password').val(),
                balance: $('#balnce').val(),
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Updated customer!");
                    window.location.href = '/test/Customers';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>