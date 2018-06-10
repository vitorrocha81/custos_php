<?php include('includes/header.php'); ?>

<?php

//Include functions
include('includes/functions.php');

?>

<?php

require('includes/pdocon.php');

$db = new Pdocon;

$db->query("SELECT * FROM admin WHERE email=:email");

$email  =   $_SESSION['user_data']['email'];

$db->bindValue(':email', $email, PDO::PARAM_STR);

$row = $db->fetchSingle();

?>



  <div class="well">

  <small class="pull-right"><a href="customers.php"> Ver usuários</a> </small>


  <?php  $fullname = $_SESSION['user_data']['fullname'];

    echo '<small class="pull-left" style="color:#337ab7;">' . $fullname .'  | Ver / Atualizar</small>';
?>

    <h2 class="text-center"> Minha Conta</h2>
     <div class="text-center"> <?php echo  $_SESSION['user_data']['email']; ?> </div>
   </div>

<div class="container">
   <div class="rows">

      <?php showmsg(); ?>

     <div class="col-md-9">

          <?php  if($row) { ?>

           <form class="form-horizontal" role="form" method="post" action="">
            <div class="form-group">
            <label class="control-label col-sm-2" for="name" style="color:#f3f3f3;">Nome:</label>
            <div class="col-sm-10">
              <input type="name" name="name" class="form-control" id="name" value="<?php echo $row['fullname'] ?>" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="email" style="color:#f3f3f3;">Email:</label>
            <div class="col-sm-10">
              <input type="email" name="email" class="form-control" id="email" value="<?php echo $row['email'] ?>" required>
            </div>
          </div>
          <div class="form-group ">
            <label class="control-label col-sm-2" for="pwd" style="color:#f3f3f3;">Senha:</label>
            <div class="col-sm-10">
             <fieldset disabled>
              <input type="password" name="password" class="form-control disabled" id="pwd" value="<?php echo $row['password'] ?>" required>
             </fieldset>
            </div>
          </div>

         <br>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <a class="btn btn-primary" href="edit_admin.php?admin_id=<?php echo $row['id'] ?>">Atualizar</a>
                <button type="submit" class="btn btn-danger pull-right" name="delete_form">Deletar</button>
            </div>
          </div>



        </form>

  </div>
       <div class="col-md-3">
           <div style="padding: 20px;">
             <div class="thumbnail" >
              <a href="edit_admin.php?admin_id=<?php echo $row['id'] ?>">

                   <?php  $image = $row['image']; ?>

                <?php echo ' <img src="uploaded_image/' . $image . '"  style="width:150px;height:150px">'; ?>
              </a>
              <h4 class="text-center"><?php //echo fullname do admin  ?></4>
            </div>
           </div>
       </div>

       <?php } ?>

  </div>

</div>

<?php

/************** Deletar conta  ******************/


if(isset($_POST['delete_form'])){

    $admin_id = $_SESSION['user_data']['id'];

    keepmsg('<div class="alert alert-danger text-center">

              <strong>Confirme por favor!</strong> Deletar sua conta? <br>
              <a href="#" class="btn btn-danger" data-dismiss="alert" aria-label="close">Não, obrigado!</a><br>
              <form method="post" action="my_admin.php">
              <input type="hidden" value="' . $admin_id .'" name="id"><br>
              <input type="submit" name="delete_admin" value="Sim, Deletar" class="btn btn-success">
              </form>
            </div>');

}

// Confirma delete


   if(isset($_POST['delete_admin'])){

    $id = $_POST['id'];

    $db->query('DELETE FROM admin WHERE id=:id');

    $db->bindValue(':id', $id, PDO::PARAM_INT);

    $run = $db->execute();

    if($run){

        redirect('logout.php');

    }else{

         keepmsg('<div class="alert alert-danger text-center">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Erro! </strong>Usuário' . $id . ' não pode ser deletado
                </div>');
    }


   }

?>

</div>

</div>

</div>
<?php include('includes/footer.php'); ?>