<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Pedido</title>
    <link rel="icon" type="image/x-icon" href="assets/img/Fondo2.png" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet" />
    <link href="../css/pedidosstyles.css" rel="stylesheet" />
</head>

<body>
    <header>
        <h1 class="site-heading text-center text-faded d-none d-lg-block">
            <!--<span class="site-heading-upper text-primary mb-3">A Free Bootstrap Business Theme</span>-->
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
                <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="index.html">Inicio</a></li>
                    <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="products.html">Productos</a></li>
                    <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="pedidos.html">Pedidos</a></li>
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
                            <span class="section-heading-lower">Realice su pedido aquí</span>
                        </h2>
                        <form id="formulario" action='Controlador/validacionPed.php' method="post">
                                <span class="section-heading-upper">Información del producto</span>
                                <article class="art-conte">
                                    <input class="input-control-ID" type="text" name="idProducto" placeholder="ID">
                                </article>
                                <article class="art-conte">
                                    <i class="fa-solid fa-user"></i>
                                    <input class="input-control" type="text" name="producto" placeholder="Producto">
                                </article>
                                <article class="art-conte">
                                    <i class="fa-solid fa-user"></i>
                                    <input class="input-control" type="text" name="material" placeholder="Material">
                                </article>

                            <p class="address mb-5"></p>
                            <span class="section-heading-upper">Datos del cliente</span>
							<article class="art-conte">
								<i class="fa-solid fa-lock"></i>
								<input class="input-control" type="text" name="nombre" placeholder="Nombre">
							</article>
                            <article class="art-conte">
								<i class="fa-solid fa-lock"></i>
								<input class="input-control" type="text" name="direccion" placeholder="Dirección">
							</article>
                            <article class="art-conte">
								<i class="fa-solid fa-lock"></i>
								<input class="input-control" type="text" name="telefono" placeholder="Teléfono">
							</article>

							<button class="btnPedido" type="submit" >Enviar para cotización<i class="fa-solid fa-right-to-bracket"></i></button>
						</form>

                        <p class="address mb-5"></p>
                        <p class="mb-0">
                            <small><em>Una vez realizado el pedido la tienda se contactará con usted para más detalles</em></small>
                            <br /> Más información a: 477-xxx-xxxx
                        </p>
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