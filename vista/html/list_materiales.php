<?php
    session_start();
    // Validar si ya hay una sesion iniciada
    if(!isset($_SESSION['usr'])){
        header("Location: Login.php");
    }else{

    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Materiales</title>
    <link rel="icon" type="image/x-icon" href="../../assets/img/Fondo2.png" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet" />
    <!-- Link a estilos de boostrap-->
    <link href="../css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.1/css/bulma.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <script src="../js/sweetalert2.min.js" type="text/javascript"></script>


</head>

<body>
    <header>
        <h1 class="site-heading text-center text-faded d-none d-lg-block">
            <img class="logo" src="../../assets/img/Fondo3.JPG" />
            <br>
            <br>
            <span class="site-heading-lower">Aries</span>
        </h1>
    </header>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
        <div class="container">
            <a class="navbar-brand text-uppercase fw-bold d-lg-none" href="index.html">Start Bootstrap</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="empleado.php">Pedidos</a></li>
                    <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="list_productos.php">Productos</a></li>
                    <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="list_materiales.php">Materiales</a></li>
                    <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="cerrar_sesion.php">Cerrar Sesion</a></li>
                    
                </ul>
            </div>
        </div>
    </nav>

    <section class="page-section cta">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="cta-inner bg-faded text-center rounded">
                        <h2 class="section-heading mb-5">
                            <span class="section-heading-upper">Lista</span>
                            <span class="section-heading-lower">Materiales</span>
                        </h2>
                        <div class="columns">
                            <div class="column">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Proveedor</th>
                                            <th>Telefono</th>
                                            <th>Editar</th>
                                        </tr>
                                    </thead>
                                    <tbody id="cuerpoTabla">
                                    </tbody>
                                </table>
                                <a class="button is-success" href="crear_material.php">Nuevo&nbsp;<i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <script src="../js/list_materiales.js"></script>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer text-faded text-center py-5">
        <div class="container">
            <p class="m-0 small">Copyright &copy; Your Website 2023</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>