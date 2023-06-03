const $nombre = document.querySelector("#nombre"),
$descripcion = document.querySelector("#descripcion"),
$marca = document.querySelector("#marca"),
$nom_prov = document.querySelector("#nom_prov"),
$tel_prov = document.querySelector("#tel_prov"),
$dir_prov = document.querySelector("#dir_prov"),
$btnGuardar = document.querySelector("#btnGuardar");

$btnGuardar.onclick = async () => {
    const nombre = $nombre.value,
        descripcion = $descripcion.value,
        marca = $marca.value,
        nom_prov = $nom_prov.value,
        tel_prov = $tel_prov.value,
        dir_prov = $dir_prov.value;
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
    if (!marca) {
        return Swal.fire({
            icon: "error",
            text: "Escribe la marca",
            timer: 700, // <- Ocultar dentro de 0.7 segundos
        });
    }
    if (!nom_prov) {
        return Swal.fire({
            icon: "error",
            text: "Escribe el nombre del proveedor",
            timer: 700, // <- Ocultar dentro de 0.7 segundos
        });
    }
    if (!tel_prov) {
        return Swal.fire({
            icon: "error",
            text: "Escribe el telefono del proveedor",
            timer: 700, // <- Ocultar dentro de 0.7 segundos
        });
    }
    if (!dir_prov) {
        return Swal.fire({
            icon: "error",
            text: "Escribe la direccion del proveedor",
            timer: 700, // <- Ocultar dentro de 0.7 segundos
        });
    }
    // Lo que vamos a enviar a PHP
    const cargaUtil = {
        nombre: nombre,
        descripcion: descripcion,
        marca: marca,
        nom_prov: nom_prov,
        tel_prov: tel_prov,
        dir_prov: dir_prov
    };

    // Codificamos para mayoor seguridad
    const cargaUtilCodificada = JSON.stringify(cargaUtil);

    // Enviamos al back esperando respuesta
    try {
        const respuestaRaw = await fetch("../../controladores/guardar_material.php", {
            method: "POST",
            body: cargaUtilCodificada,
        });
        // El servidor nos responderá con JSON
        const respuesta = await respuestaRaw.json();
        if (respuesta) {

            // Y si llegamos hasta aquí, todo ha ido bien
            Swal.fire({
                icon: "success",
                text: "Material guardado",
                timer: 700, // <- Ocultar dentro de 0.7 segundos
            });
            // Limpiamos el formulario
            $nombre.value = $descripcion.value = $marca.value = $nom_prov.value = $dir_prov.value = $tel_prov.value = "";
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