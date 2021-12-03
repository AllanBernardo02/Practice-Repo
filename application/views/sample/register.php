<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU"
      crossorigin="anonymous"
    />
    <style>
    .error{
        color: red;
    }
</style>
</head>
<body>    
    
    <?php  echo form_open("example/register_validation", array(
    "method" => "post",
    "enctype" => "multipart/form-data")); ?>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Username</label>
        <input type="text" class="form-control" name="username_txt" >
        <?php  echo form_error("username_txt","<div class='error'>","</div>"); ?>

    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" name="password1_txt" id="exampleInputPassword1">
        <?php  echo form_error("password1_txt","<div class='error'>","</div>"); ?>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Re-write Password</label>
        <input type="password" class="form-control" name="password2_txt" id="exampleInputPassword1">
        <?php  echo form_error("password2_txt","<div class='error'>","</div>"); ?>
    </div>
     <?php if($this->session->flashdata("not_equal")) { 
    ?>
    <div class="error">
        <?php echo $this->session->flashdata("not_equal") ?>
    </div>
    <?php 
    }
    ?>

    <button type="submit" class="btn btn-primary">Register</button>
   <?php echo form_close(); ?>
   <div>
       <span>Already have an account?</span>
    <a href= "<?php echo site_url("example/login") ?>" > Login here </a>

   </div>


</body>
</html>