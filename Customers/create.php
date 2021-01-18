<?php
include('../Template/header.php');
include('../Template/sidenav.php');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
             customer
              <small> Dashboard</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> CustView</a></li>
              <li class="active">Create New customer</li>
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
                            <h3 class="box-title">Add customer</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form role="form">
                            <div class="box-body">
                                <div class="form-group">
                                <label for="exampleInputName1">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter customer Name" maxlength="20" required>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputName1" >Username</label>
                                <input type="text"  id="username" class="form-control" placeholder="Enter customer userrname" maxlength="20" required >
                            </div>

                        
                            <div class="form-group">
                                <label  for="exampleInputName1" >Address</label>
                               
                                <textarea  id="address" class="form-control" rows="4"  placeholder="Enter address" maxlength="60" required></textarea>
                            </div>


                            <div class="form-group">
                                <label  for="exampleInputPassword1" >Paasword</label>
                                <input type="password" id="code" class="form-control" maxlength="5" placeholder="Enter postal code" >
                            </div>


                            <div class="form-group">
                                <label  for="exampleInputName1" >Balance</label>
                                <input type="balance"  id="cell" class="form-control" placeholder="Enter cellphone no" maxlength="10" required pattern="[+-]?([0-9]*[.])?[0-9]+" >
                            </div>

                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                          <input type="button" class="btn btn-primary" onClick="AddClient()" value="Submit"></input>
                          <a href="/CustView/clients" class="btn btn-info">Back</a>
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
<script>
  function AddClient(){

        $.ajax(
        {
            type: "POST",
            url: '../api/customer/create.php',
            dataType: 'json',
            data: {
                name: $("#name").val(),
                username: $("#username").val(),
                address: $("#address").val(),
                password: $("#password").val(), 
                balance: $("#balance").val()
              
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Added New customer!");
                    window.location.href = '/test/Customers';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
  
</script>