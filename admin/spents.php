<?php include('includes/header.php'); ?>


<?php
include('includes/functions.php');
?>

<?php

require('includes/pdocon.php');

$db = new Pdocon;

$db->query('SELECT * FROM gastos');

$results = $db->fetchMultiple();

?>

  <div class="container">

   <?php showmsg(); ?>

  <div class="jumbotron">

  <small class="pull-right"><a href="register_spent.php"> Adicionar Despesa  </a> </small>

  <?php echo $_SESSION['user_data']['fullname'] ?>

    <h2 class="text-center">ÙLTIMAS DESPESAS</h2> <hr>
    <br>

     <table class="table table-bordered table-hover text-center">
        <thead >
          <tr>
            <th class="text-center"> ID</th>
            <th class="text-center">Nome</th>
            <th class="text-center">Valor</th>
            <th class="text-center">Detalhes</th>
          </tr>
        </thead>
        <tbody>
        <?php

$sumArray = array();

foreach ($results as $k=>$subresults) {
  foreach ($subresults as $id=>$value) {
    $sumArray[$id]+=$value;
  }
}

echo '<h2>Total de despesas: R$ '.  money_format('%i',($sumArray['spending'])) . '</h2>';

?>
    <?php  foreach($results as $result) : ?>
          <tr>

            <td><?php echo $result['id'] ?></td>
            <td><?php echo $result['nome'] ?></td>
            <td><?php echo $result['spending'] ?></td>
            <td><a href="reports.php?cus_id=<?php echo $result['id'] ?>" class='btn btn-primary'>Detalhes</a></td>
            <td><a href="edit.php?cus_id=<?php echo $result['id'] ?>" class='btn btn-danger'>Atualizar</a></td>

          </tr>

          <?php endforeach ; ?>
        </tbody>
     </table>
</div>
  </div>

</div>


<?php include('includes/footer.php'); ?>