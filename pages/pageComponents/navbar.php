<!-- NavBar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mx-50px">
    <div class="container col-lg-9 p-0">
        <a class="navbar-brand text-warning" href="index.php">Battelli Venezia <i class="fas fa-compass    "></i></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active" id="home">
                    <a class="nav-link" href="index.php">Percorsi</a> <!-- <span class="sr-only">(current)</span> -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="map.php">Mappa</a>
                </li>
<!--                 <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li> -->
            </ul>
            
        <?php if (isset($_SESSION['user'])) {
            echo '<ul class="navbar-nav">
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user-circle text-warning" aria-hidden="true" style="color: "></i> '. $_SESSION['user'] .'
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="profile.php">Gestisci profilo <i class="fas fa-wrench"></i></a>
                    <a class="dropdown-item" href="#">Percorsi preferiti <i class="fa fa-heart" aria-hidden="true" style="color:red;"></i></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="pages\logout.php">Esci <i class="fa fa-sign-out" aria-hidden="true"></i></a>
                </div>
            </li>
        </ul>';
        }else{
            echo '<p class="lead my-2 my-lg-0">
            <a class="btn btn-warning" href="./index.php" role="button" data-toggle="modal"
                data-target="#loginModal">Accedi</a>
            <a class="btn btn-warning" href="./index.php" role="button" data-toggle="modal"
                data-target="#registerModal">Registrati</a>
            </p>';
        }
        ?>
            
<!--             <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form> -->

        </div>
    </div>
</nav>

<script>
    $(document).ready(function () {     
        $('.nav-item a').each(function(){
            if ($(this).prop('href') == window.location.href) {
                $(this).addClass('active'); $(this).parents('li').addClass('active');
                $("#home").removeClass('active');
            }
        });
    });
</script>