<?php include('includes/header.php'); ?>


<?php

//Include functions
include('includes/functions.php');

?>

<?php
 /// Cadastrando novo usuário

//require database class files
require('includes/pdocon.php');


//instatiating our database objects
$db = new Pdocon;


//Collect and clean values from the form
if(isset($_POST['submit_user'])){

    $raw_name           =   cleandata($_POST['name']);
    $raw_amount         =   cleandata($_POST['amount']);
    $raw_email          =   cleandata($_POST['email']);


    $c_name             =   sanitazestr($raw_name);
    $c_amount           =   validateiNT($raw_amount);

    $db->query('INSERT INTO gastos(id, nome, spending) VALUES (NULL, :nome,  :spending) ');

    $db->bindValue(':nome', $c_name, PDO::PARAM_STR);
    $db->bindValue(':spending', $c_amount, PDO::PARAM_STR);

    $run_spent = $db->execute();


    if($run_spent){

        redirect('spents.php');

        keepmsg('<div class="alert alert-success text-center">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Usuário cadastrado com sucesso!</strong>
                </div>');

    }else{

         keepmsg('<div class="alert alert-danger text-center">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Erro!</strong> Usuário não pode ser registrado, por favor confira os dados e tente novamente.
                </div>');
    }
}


?>


    <div class="row">
      <div class="col-md-4 col-md-offset-4">
          <p class="pull-right" style="color:#777"> Cadastro usuário/funcionároi</p><br>
      </div>
      <div class="col-md-4 col-md-offset-4">
           <form class="form-horizontal" role="form" method="post" action="register_spent.php">
            <div class="form-group">
            <label class="control-label col-sm-2" for="name"></label>
            <div class="col-sm-10">
              <input type="name" name="name" class="form-control" id="name" placeholder="Nome Completo" required>
            </div>
          </div>
            <div class="form-group">
            <label class="control-label col-sm-2" for="salary"></label>
            <div class="col-sm-10">
              <input type="text" name="amount" class="form-control" id="country" placeholder="Salario" required>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10 text-center">
              <button type="submit" class="btn btn-primary pull-right" name="submit_user">Cadastrar</button>
              <a class="pull-left btn btn-danger" href="customers.php"> Cancelar</a>
            </div>
          </div>
</form>

  </div>
</div>

  </div>
</div>

<?php include('includes/footer.php'); ?>