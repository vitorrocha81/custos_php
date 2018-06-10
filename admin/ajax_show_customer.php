<?php include('includes/header.php'); ?>


<?php


//Include functions
include('includes/functions.php');

?>



<?php


$id = $_GET['cid'];

require('includes/pdocon.php');

$db = new Pdocon;


$db->query('SELECT * FROM gastos WHERE id=:id');


$db->bindValue(':id', $id, PDO::PARAM_INT);


$row = $db->fetchSingle();


    if($row){

        echo '  <div  class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr >
                                <th class="text-center">Despesa</th>
                                <th class="text-center">Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                           <tr class="text-center">
                            <td>' . $row['nome'] . '</td>
                            <td>' . number_format($row['spending'], 2) . '</td>
                          </tr>

                        </tbody>
                    </table>
                </div>';

    }



?>

