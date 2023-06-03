<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Editar Producto</title>
    <link rel="icon" type="image/x-icon" href="../../assets/img/Fondo2.png" />
    <!-- Google fonts-->
    <link
        href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet" />
    <!-- Link a estilos de boostrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="../css/styles.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/jquery-3.7.0.min.js"></script>
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="empleado.html">Pedidos</a>
                    </li>
                    <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="list_productos.html">Productos</a></li>
                    <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="list_materiales.html">Materiales</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="page-section cta">
        <div class="container">
            <img class="img-fluid rounded about-heading-img mb-3 mb-lg-0" src="assets/img/about.jpg" alt="..." />
            <div class="about-heading-content">
                <div class="row">
                    <div class="col-xl-9 col-lg-10 mx-auto">
                        <div class="bg-faded rounded p-5">
                            <div class="columns">
                                <div class="column is-one-third">
                                    <h2 class="is-size-2">Editar producto</h2>
                                    <div class="field">
                                        <label for="nombre">Nombre</label>
                                        <div class="control">
                                            <input required id="nombre" class="input" type="text" placeholder="Nombre"
                                                name="nombre">
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label for="material">Material</label>
                                        <div class="control">
                                            <select id="materiales_lista" onChange="getNumMaterial()">
                                                <input required id="idMat" class="input" type="text" placeholder="idMat" name="idMat">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label for="descripcion">Descripción</label>
                                        <div class="control">
                                            <textarea name="descripcion" class="textarea" id="descripcion" cols="30"
                                                rows="5" placeholder="Descripción" required></textarea>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label for="precio">Precio</label>
                                        <div class="control">
                                            <input required id="precio" name="precio" class="input" type="number"
                                                placeholder="Precio">
                                        </div>
                                    </div> <br>
                                    <div class="field">
                                        <input type="file" accept=".png, .jpg, .jpeg" id="file_img_prod" style="display:none">
                                        <button type="button" class="btn btn-info" style="color: white !important;" id="btn_carga_foto">Cambiar fotograf&iacute;a</button>
                                        <button type="button" class="btn btn-warning" style="color: white !important;" data-target=".bd-example-modal-lg" id="btn_ver_foto">Ver fotograf&iacute;a</button>
                                    </div> <br>
                                    <div class="field">
                                        <div class="control">
                                            <button type="button" id="btnGuardar" class="btn btn-success" style="color: white !important;">Guardar</button> &nbsp;
                                            <button onclick="location.href= 'list_productos.php'" type="button" id="btnVolver" class="btn btn-danger" style="color: white !important;">Volver</button>
                                            <!--<a href="list_productos.html" class="button is-warning">Volver</a>-->

                                        </div>

                                    </div>
                                    </div>
                                </div>
                            </div>
                            <script src="../js/editar_producto.js"></script>
                            <script src="../js/mostrarListaMateriales.js"></script>
                        </div>
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

    <!-- MODAL FOTO -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal_img">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Foto producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn_cerrar_modal">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form>
                    <div class="form-group">
                    <img id="img_foto" src="" class="rounded float-left" alt="Responsive image" style="width: 100% !important;">
                    </div>
            </form>
                
            </div>   
        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>