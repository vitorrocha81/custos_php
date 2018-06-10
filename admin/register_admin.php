<?php
include('../includes/header.php');


// FUNCÇÕES DE TODO SISTEMA - PARA ADINS
include('includes/functions.php');


?>


<?php
/************** registrando novo admin  ******************/

require('includes/pdocon.php');


$db = new Pdocon;


if(isset($_POST['submit_login'])){

    $raw_name           =   cleandata($_POST['name']);
    $raw_sex            =   cleandata($_POST['sex']);
    $raw_email          =   cleandata($_POST['username']);
    $raw_password       =   cleandata($_POST['password']);


    $c_name             =   sanitazestr($raw_name);
    $c_sex              =   sanitazestr($raw_sex);
    $c_email            =   validateEmail($raw_email);
    $c_password         =   sanitazestr($raw_password);

    $hashed_Pass        =   hash_password($c_password);

    //Collect Image
    $c_img              =   $_FILES['image']['name'];
    $c_img_tmp          =   $_FILES['image']['tmp_name'];

    //move image to permanent location
    move_uploaded_file($c_img_tmp, "uploaded_image/$c_img");


    $db->query("SELECT * FROM admin WHERE email = :email");

    $db->bindvalue(':email', $c_email, PDO::PARAM_STR);

    $row = $db->fetchSingle();


    if($row){

        echo '<div class="alert alert-danger text-center">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Sorry!</strong> User already Exist. Register or Try Again
            </div>';

    }else{

        $db->query("INSERT INTO admin(id, fullname, email, password, sex, image) VALUES(NULL, :fullname, :email, :password, :sex, :image) ");

        $db->bindvalue(':fullname', $c_name, PDO::PARAM_STR);
        $db->bindvalue(':email', $c_email, PDO::PARAM_STR);
        $db->bindvalue(':password', $hashed_Pass, PDO::PARAM_STR);
        $db->bindvalue(':sex', $c_sex, PDO::PARAM_STR);
        $db->bindvalue(':image', $c_img, PDO::PARAM_STR);

        $run = $db->execute();

        if($run){

            echo '<div class="alert alert-success text-center">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Success!</strong> Admin registrado com sucesso!
                  </div>';

        }else{

             echo '<div class="alert alert-danger text-center">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Sorry!</strong> Erro ao registrar, por favor, confira os dados.
            </div>';
        }


    }



}



?>


    <div class="row">
      <div class="col-md-4 col-md-offset-4">
          <p class=""><a class="pull-right" href="../index.php"> Login</a></p><br>
      </div>
      <div class="col-md-4 col-md-offset-4">
        <form class="form-horizontal" role="form" method="post" action="register_admin.php" enctype="multipart/form-data">
          <div class="form-group">
            <label class="control-label col-sm-2" for="name"></label>
            <div class="col-sm-10">
              <input type="name" name="name" class="form-control" id="name" placeholder="Nome completo" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="sex"></label>
            <div class="col-sm-10">
              <select type="" name="sex" class="form-control" id="sex" >
                  <option value="">Sexo</option>
                  <option value="Male">Masculino</option>
                  <option value="Female">Feminino</option>
                  <option value="Secret">N/A</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="email"></label>
            <div class="col-sm-10">
              <input type="email" name="username" class="form-control" id="email" placeholder=" Email" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="pwd"></label>
            <div class="col-sm-10">
              <input type="password" name="password" class="form-control" id="pwd" placeholder="Senha" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="image"></label>
            <div class="col-sm-10">
              <input type="file" name="image" id="image" placeholder="Escolha a foto do perfil" required>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
                <label><input type="checkbox" required> Aceito as regras</label>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10 text-center">
              <button type="submit" class="btn btn-primary pull-right" name="submit_login">Register</button>
              <a class="pull-left btn btn-danger" href="../index.php"> Cancel</a>
            </div>
          </div>
</form>

  </div>
</div>

  </div>
</div>

<?php include('includes/footer.php'); ?>