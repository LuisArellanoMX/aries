const $nombre = document.querySelector("#nombre"),
    $descripcion = document.querySelector("#descripcion"),
    $marca = document.querySelector("#marca"),
    $nom_prov = document.querySelector("#nom_prov"),
    $tel_prov = document.querySelector("#tel_prov"),
    $dir_prov = document.querySelector("#dir_prov"),
    $btnGuardar = document.querySelector('#btnGuardar') 

// Una global para establecerla al rellenar el formulario y leerla al enviarlo
let idMaterial;
let material;

const rellenarFormulario = async() => {

    const urlSearchParams = new URLSearchParams(window.location.search);
    idMaterial = urlSearchParams.get("id"); // <-- Actualizar el ID global
    // Obtener el producto desde PHP
    const respuestaRaw = await fetch(`../../controladores/obtener_material_por_id.php?id=${idMaterial}`);
    material = await respuestaRaw.json();
    
    // Rellenar formulario
    $nombre.value = material.nombre_Material;
    $descripcion.value = material.descripcion;
    $marca.value = material.marca;
    $nom_prov.value = material.nombreContacto
    $tel_prov.value = material.telefono
    $dir_prov.value = material.direccion
};

// Al incluir este script, llamar a la función inmediatamente
rellenarFormulario();

$btnGuardar.onclick = async() => {

    
    // Se comporta igual que cuando guardamos uno nuevo
    const nombre = $nombre.value,
    descripcion = $descripcion.value,
    marca = $marca.value,
    nom_prov = $nom_prov.value,
    tel_prov = $tel_prov.value,
    dir_prov = $dir_prov.value

        /*
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
    */
    // Lo que vamos a enviar a PHP. También incluimos el ID
    const cargaUtil = {
        id: idMaterial,
        nombre : nombre,
        descripcion : descripcion,
        marca : marca,
        nom_prov : nom_prov,
        tel_prov : tel_prov,
        dir_prov : dir_prov,
        id_prov : material.idProveedor
    };

    // Codificamos...
    const cargaUtilCodificada = JSON.stringify(cargaUtil);
    // Enviamos
    try {
        const respuestaRaw = await fetch("../../controladores/actualizar_material.php", {
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