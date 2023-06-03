let idPedido 

const $nombre = document.querySelector("#nombre"),
    $direccion = document.querySelector("#direccion"),
    $telefono = document.querySelector("#telefono"),
    $producto = document.querySelector("#producto"),
    $descripcion = document.querySelector("#descripcion"),
    $foto = document.querySelector("#foto"),
    $precio = document.querySelector('#precio')


const mostrarDetalles = async() => {

    const urlSearchParams = new URLSearchParams(window.location.search);
    idPedido = urlSearchParams.get("id"); // <-- Actualizar el ID global

    console.log(idPedido)

    // Obtener el pedido desde PHP
    const respuestaRaw = await fetch(`../../controladores/obtener_pedido_por_id.php?id=${parseInt(idPedido)}`);
    const pedido = await respuestaRaw.json();

    console.log(pedido)
    // Rellenar Datos

    $nombre.innerHTML = pedido.nombre;
    $direccion.innerHTML = pedido.direccion;
    $telefono.innerHTML = pedido.telefono;
    $producto.innerHTML = pedido.nombre_producto;
    $descripcion.innerHTML = pedido.descripcion;
    $precio.innerHTML = pedido.precio;
    const pathBase = 'http://localhost/global_files/ftp/' + pedido.foto;
    console.log(pathBase);
    $("#foto").attr('src', (pathBase));
};

mostrarDetalles()