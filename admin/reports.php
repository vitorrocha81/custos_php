<?php include('includes/header.php'); ?>


<?php

//Include functions
include('includes/functions.php');


?>
<?php

//Get ID and pass it on to ajax
$id = $_GET['cus_id'];

?>


<script>

$(document).ready(function(){

    setInterval(function(){ display_report_menu(); }, 500);
    setInterval(function(){ display_customer_info(); }, 1000);

    function display_report_menu(){

        $.ajax({

            url: 'ajax_report_menu.php?cid=<?php echo $id; ?>',
            type: 'POST',
            success: function(show_report){

                if(show_report){

                    $("#report_menu").html(show_report);
                }
            }

        });

    }

    function display_customer_info(){


        $.get("ajax_show_customer.php?cid=<?php echo $id; ?>", function(show_customer){ $("#customerinfo").html(show_customer)});

    }
});

</script>

    <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">
                           Logado como: <?php echo $_SESSION['user_data']['fullname'] ?>
                        </h3>
                        <ol class="breadcrumb">
                            <small class="pull-right"><a href="spents.php"> Ver despesas </a> </small>
                        </ol>
                    </div>
                </div>

                <div class="row" id="report_menu">

                </div>

                <div class="row">

                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title text-center"><i class="fa fa-money fa-fw"></i> Detalhes da despesa</h3>
                            </div>
                            <div id="customerinfo" class="panel-body" style="background-color:lightgrey;">
                                 <!-- Dados da conta  via ajax -->

                                <div class="text-right">
                                    <a href="#"><i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4">

                    </div>


                    <script>
            /************** Atualizando dados pelo id  ******************/

                    $(document).ready(function(){

                        $("#updatedata").submit(function(stop_default){

                            stop_default.preventDefault();

                            var url     = $(this).attr("action");

                            var data    = $(this).serialize();

                            $.post(url, data, function(confirm){

                                $("#alert_success").html(confirm);
                            });


                            $("#updatedata")[0].reset();


                        });



                    });

                </script>

                </div>

            </div>

        </div>
<?php include('includes/footer.php'); ?>