<h3>Form</h3>
<style>
    .error{
        color: red;
    }
</style>
<?php if($this->session->flashdata("success")) { 
    ?>
    <div>
        <?php echo $this->session->flashdata("success") ?>
    </div>
    <?php 
}
?>
<?php echo form_open('example/displayform', array(
    "method" => "post",
    "enctype" => "multipart/form-data"));
    
    ?>
<input type="text" placeholder="name" name="name_txt" >
<br>
<br>
<?php  echo form_error("name_txt","<div class='error'>","</div>"); ?>

<br>

<input type="text" placeholder="last_name" name="last_name_txt" >
<br>
<br>
<?php  echo form_error("last_name_txt","<div class='error'>","</div>"); ?>
<br>

<input type="email" placeholder="email" name="email_txt" >
<br>
<br>

<?php  echo form_error("email_txt","<div class='error'>","</div>"); ?>

<br>

<input type="password" placeholder="password" name="pass_txt" >
<?php  echo form_error("pass_txt","<div class='error'>","</div>"); ?>

<br>


<button type="submit" value="something">submit</button>
<?php echo form_close(); ?>
