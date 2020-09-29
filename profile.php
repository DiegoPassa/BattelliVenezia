<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        /* HEAD */
        require "./pages/pageComponents/head.php";
    ?>
</head>

<body>

    <?php 
        /* NAVBAR */
        include "./pages/pageComponents/navbar.php";
    ?>

    <div class="container-fluid">
        <div class="row" style="">
            <div class="col-lg" style="font-size:25px; text-align:center;">
                <!-- <i class="fas fa-ad    "></i> -->
            </div>
            <div class="col-lg-9 py-4">
                <div class="jumbotron mb-3">
                    <h1 class="display-4 mb-3">Modifica il tuo profilo</h1> <!-- <i class="fas fa-compass"></i> -->
                    <p id="nome" class="text-justify mb-2 info app"><strong>Nome: </strong></p>
                    <p id="cognome" class="text-justify mb-2 info app"><strong>Cognome: </strong></p>
                    <p id="email" class="text-justify mb-2 info app"><strong>Email: </strong></p>
                    <p id="DoB" class="text-justify mb-2 info app"><strong>Data di nascita: </strong></p>
                    <p id="totalSearch" class="text-justify mb-2 info"><strong>Percorsi cercati: </strong></p>
                    <p id="dataReg" class="text-justify mb-2 info"><strong>Data di registrazione: </strong> <span class="text-muted"></span></p>
                    <button href="./pages/deleteAccount.php" type="button" class="btn btn-primary">Cambia password</button>
                    <a class="btn btn-danger" href="./index.php" role="button" data-toggle="modal"
                    data-target="#deleteAccount">Elimina profilo</a>
                </div>           
                <div class="row">

                </div>
            </div>
            <div class="col-lg" style="font-size:25px; text-align:center;">
                <!-- <i class="fas fa-ad    "></i> -->
            </div>
        </div>
    </div>

    <script>
        $.ajax({
            type: "post",
            url: "./pages/getUserInfo.php",
            data: "",
            dataType: "json",
            success: function (response) {
                $("#nome").append(response[0].name);
                $("#cognome").append(response[0].lastName);
                $("#email").append(response[0].email);
                $("#DoB").append(response[0].dateOfBirth);
                $("#totalSearch").append(response[0].totalSearch);
                $("#dataReg").find("span").append(response[0].registerDate);
            }
        });

        $(document).ready(function () {
            $("#deleteButton").click(function (e) { 
                e.preventDefault();
                location.href = "./pages/deleteAccount.php";
            });
        });

        /* $(document).ready(function () {
            $(".info.app").append(' <i class="fa fa-pencil-square-o" style="display: none;" aria-hidden="true"></i>');
        }); */
        /* $(".info").mouseenter(function (){ 
            $(this).animate({
                fontSize: "105%"
            }, 300);
            $(this).find('i').show('fade',50);

            $(this).find('i').click(function (e) { 
                e.preventDefault();
                $(this).toggleClass("fa fa-pencil-square-o");
                $(this).html('<button type="button" class="btn btn-primary">Cambia</button>');
                $(this).prev().html('<input type="text">');
                
            });
            
                     
		}); */
        /* $(".info").mouseleave(function (){ 
			$(this).animate({
                fontSize: "100%"
            }, 300);			
            $(this).find('i').hide('fade',50);
		}); */
    </script>
    
</body>
</html>

<!-- Modal Login -->
<div class="modal fade" id="deleteAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm " role="document">
      <div class="modal-content">
        <div class="modal-header rounded-top bg-dark text-white">
          <h5 class="modal-title" id="exampleModalCenterTitle">Conferma</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div>Stai per eliminare il tuo profilo.</div>
            <h6>Premendo il pulsante <span class="text-danger">elimina</span> il tuo profilo verrà eliminato!</h6>
        </div>
        <div class="modal-footer bg-light">
          <button type="reset" class="btn btn-primary" data-dismiss="modal">Annulla</button>
          <button type="submit" class="btn btn-danger" id="deleteButton">Elimina</button>
        </div>
      </div>
    </div>
  </div>