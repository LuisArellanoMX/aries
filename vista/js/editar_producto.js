const $nombre = document.querySelector("#nombre"),
    $descripcion = document.querySelector("#descripcion"),
    $precio = document.querySelector("#precio"),
    $idMat = document.querySelector("#idMat"),
    $btnGuardar = document.querySelector("#btnGuardar");

var fotoProd = null;
var tamanioFotoProd = null;
var extensionFotProd = null;
var nombreFotoProd = null;

$(document).ready(function() {
    console.log('READY!!');

    //Set event button "carga foto"
    $('#btn_carga_foto').click(function() {
        $('#file_img_prod').click();
    });

    // Load picture and get base64
    $('#file_img_prod').change(function() {
        selectFileProd();
    });

    $('#btn_ver_foto').click(function() {
        $('#modal_img').modal('show');
    });

    $('#btn_cerrar_modal').click(function() {
        $('#modal_img').modal('hide');
    });
});

function selectFileProd() {
    if ($('#file_img_prod').prop("files")[0] !== undefined && $('#file_img_prod').prop("files")[0] !== null) {

        if ($('#file_img_prod').prop("files").length === 1) {

            if ($('#file_img_prod').prop("files")[0].type.includes('jpeg') ||
                $('#file_img_prod').prop("files")[0].type.includes('jpg') ||
                $('#file_img_prod').prop("files")[0].type.includes('png')) {

                console.log($('#file_img_prod').prop("files")[0]);

                const arrDatosArch = $('#file_img_prod').prop("files")[0].name.split('.');
                let reader = new FileReader();

                tamanioFotoProd = $('#file_img_prod').prop("files")[0].size;
                extensionFotProd = '.' + (arrDatosArch[(arrDatosArch.length - 1)]);
                nombreFotoProd = $('#file_img_prod').prop("files")[0].name.replace(extensionFotProd, "") + '_' + new Date().getTime().toString();

                // File to Base64
                reader.readAsDataURL($('#file_img_prod').prop("files")[0]);
                reader.onload = (_event) => {

                    reader.onload = this.handleReaderLoadedProd.bind(this);
                    reader.readAsBinaryString($('#file_img_prod').prop("files")[0]);
                };

            }
        }
    }
}

function handleReaderLoadedProd(readerEvt) {
    const binaryString = readerEvt.target.result;
    fotoProd = btoa(binaryString);
}

// Una global para establecerla al rellenar el formulario y leerla al enviarlo
let idProducto;

const rellenarFormulario = async() => {

    const urlSearchParams = new URLSearchParams(window.location.search);
    idProducto = urlSearchParams.get("id"); // <-- Actualizar el ID global
    // Obtener el producto desde PHP
    const respuestaRaw = await fetch(`../../controladores/obtener_producto_por_id.php?id=${idProducto}`);
    const producto = await respuestaRaw.json();
    // Rellenar formulario
    $nombre.value = producto.nombre_producto;
    $descripcion.value = producto.descripcion;
    $precio.value = producto.precio;
    $idMat.value = producto.idMaterial;
    const pathBase = 'http://localhost/global_files/ftp/' + producto.foto;
    console.log(pathBase);
    $("#img_foto").attr('src', (pathBase));
    //$('#img_foto"').prop('src', pathBase);
};

// Al incluir este script, llamar a la función inmediatamente
rellenarFormulario();

$btnGuardar.onclick = async() => {
    // Se comporta igual que cuando guardamos uno nuevo
    const nombre = $nombre.value,
        descripcion = $descripcion.value,
        idMat = parseFloat($idMat.value),
        precio = parseFloat($precio.value);
    // Pequeña validación, aunque debería hacerse del lado del servidor igualmente, aquí es pura estética
    if (!nombre) {
        return Swal.fire({
            icon: "error",
            text: "Escribe el nombre",
            timer: 700, // <- Ocultar dentro de 0.7 segundos
        });
    }
    if (!descripcion) {
        return Swal.fire({
            icon: "error",
            text: "Escribe la descripción",
            timer: 700, // <- Ocultar dentro de 0.7 segundos
        });
    }

    if (!precio) {
        return Swal.fire({
            icon: "error",
            text: "Escribe el precio",
            timer: 700, // <- Ocultar dentro de 0.7 segundos
        });
    }

    if (fotoProd === null || fotoProd === undefined) {
        return Swal.fire({
            icon: "error",
            text: "Carga la foto del producto",
            timer: 700, // <- Ocultar dentro de 0.7 segundos
        });
    }
    // Lo que vamos a enviar a PHP. También incluimos el ID
    const cargaUtil = { 
        id: idProducto,
        nombre: nombre,
        descripcion: descripcion,
        precio: precio,
        foto: fotoProd,
        idMat: idMat,
        tamanioFotoProd: tamanioFotoProd,
        extensionFotProd: extensionFotProd,
        nombreFotoProd: nombreFotoProd
    };
    // Codificamos...
    const cargaUtilCodificada = JSON.stringify(cargaUtil);
    // Enviamos
    try {
        const respuestaRaw = await fetch("../../controladores/actualizar_producto.php", {
            method: "PUT",
            body: cargaUtilCodificada,
        });
        // El servidor nos responderá con JSON
        const respuesta = await respuestaRaw.json();
        if (respuesta) {
            // Y si llegamos hasta aquí, todo ha ido bien
            // Esperamos a que la alerta se muestre
            await Swal.fire({
                icon: "success",
                text: "Producto actualizado",
                timer: 700, // <- Ocultar dentro de 0.7 segundos
            });
            // Redireccionamos a todos los productos
            window.location.href = "../html/list_productos.php";
        } else {
            Swal.fire({
                icon: "error",
                text: "El servidor no envió una respuesta exitosa",
            });
        }
    } catch (e) {
        // En caso de que haya un error
        Swal.fire({
            icon: "error",
            title: "Error de servidor",
            text: "Inténtalo de nuevo. El error es: " + e,
        });
    }
};