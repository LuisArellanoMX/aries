const $cuerpoTabla = document.querySelector("#cuerpoTabla");

const obtenerMateriales = async () => {
    // Es una petición GET, no necesitamos indicar el método ni el cuerpo
    const respuestaRaw = await fetch("../../controladores/obtener_materiales.php");
    const materiales = await respuestaRaw.json();
    // Limpiamos la tabla
    $cuerpoTabla.innerHTML = "";
    // Ahora ya tenemos a los pedidos. Los recorremos
    for (const material of materiales) {
        // Vamos a ir adjuntando elementos a la tabla.
        const $fila = document.createElement("tr");
        const $celdaNombre = document.createElement("td");
        $celdaNombre.innerText = material.nombre_Material;
        $fila.appendChild($celdaNombre);
        const $celdaDescripcion = document.createElement("td");
        $celdaDescripcion.innerText = material.descripcion;
        $fila.appendChild($celdaDescripcion);
        const $celdaContacto = document.createElement("td");
        $celdaContacto.innerText = material.nombreContacto;
        $fila.appendChild($celdaContacto);
        const $celdaTelefono = document.createElement("td");
        $celdaTelefono.innerText = material.telefono;
        $fila.appendChild($celdaTelefono);
        console.log(material)
        // Link editar
        const idMaterial = material.idMaterial;
        const $linkEditar = document.createElement("a");
        $linkEditar.href = "../html/editar_material.php?id=" + idMaterial;
        $linkEditar.innerHTML = `<i class="fa fa-edit"></i>`;
        $linkEditar.classList.add("button", "is-warning");
        const $celdaLinkEditar = document.createElement("td");
        $celdaLinkEditar.appendChild($linkEditar);
        $fila.appendChild($celdaLinkEditar);

        $cuerpoTabla.appendChild($fila);
    }
};

// Y cuando se incluya este script, invocamos a la función
obtenerMateriales();