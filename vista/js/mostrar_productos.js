
function crearProducto(nombreProducto, id, descripcion, precio, ruta){
    let main = $('#main');
    let section = $('<section class="page-section"></section>');
    let div1 = $('<div class="container"></div>');
    div1.appendTo(section);
    let div2 = $('<div class="product-item"></div>');
    div2.appendTo(div1)

    let div3 = $('<div class="product-item-title d-flex"></div>')
    div3.appendTo(div2)
    let div4 = $('<div class="bg-faded p-5 d-flex ms-auto rounded">');
    div4.appendTo(div3)
    let h2 = $('<h2 class="section-heading mb-0">')
    h2.appendTo(div4)

    let span1 = $('<span class="section-heading-lower"><strong>'+ nombreProducto +'</strong></span>')
    span1.appendTo(h2)

    let img = $('<img heigth="435" width="700" class="product-item-img mx-auto d-flex rounded img-fluid mb-3 mb-lg-0" src="http://localhost/global_files/ftp/'+ruta+'" alt="..." />')
    img.appendTo(div2)

    let div5 = $('<div class="product-item-description d-flex me-auto">')
    div5.appendTo(div2)

    let div6 = $('<div class="bg-faded p-5 rounded">')
    div6.appendTo(div5)

    let p1 = $('<p class="mb-0"><strong>Precio:</strong> '+precio+'</p>')
    p1.appendTo(div6)
    let p2 = $('<p class="mb-0"><strong>Numero de producto: </strong>'+id+'</p>')
    p2.appendTo(div6)
    let p3 = $('<p class="mb-0"><strong>Descripcion:</strong> <br>'+descripcion+'</p>')
    p3.appendTo(div6)
    let btn = $('<button onclick="location.href=\'pedidos.html?id='+id+'\'" type="button" id="btnVolver" class="btn btn-info" style="color: white !important;">Realizar pedido</button>')
    btn.appendTo(div6)
    section.appendTo(main)
}


//crearProducto("Producto 1", 5, "Producto chido", "1200","1/img/productos/pass_1685506699180.png")

const obtenerProductos = async () => {
    // Es una petición GET, no necesitamos indicar el método ni el cuerpo
    const respuestaRaw = await fetch("../../controladores/obtener_productos.php");
    const productos = await respuestaRaw.json();
    console.log(productos);

    for(const producto of productos){
        crearProducto(producto.nombre_producto, producto.idProducto, producto.descripcion, producto.precio,producto.foto)
    }
}

obtenerProductos();