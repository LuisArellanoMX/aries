const $cuerpoTabla = document.querySelector("#cuerpoTabla");

const obtenerPedidos = async() => {
    // Es una petición GET, no necesitamos indicar el método ni el cuerpo
    const respuestaRaw = await fetch("../../controladores/obtener_pedidos.php");
    //regresa respuesta en json
    const pedidos = await respuestaRaw.json();
    // Limpiamos la tabla
    $cuerpoTabla.innerHTML = "";
    // Ahora ya tenemos a los pedidos. Los recorremos
    for (const pedido of pedidos) {
        // Vamos a ir adjuntando elementos a la tabla.
        const $fila = document.createElement("tr");
        // La celda del nombre
        const $celdaNombre = document.createElement("td");
        // Colocamos su valor y lo adjuntamos a la fila
        $celdaNombre.innerText = pedido.nombre_producto;
        $fila.appendChild($celdaNombre);
        // Lo mismo para lo demás
        const $celdaCliente = document.createElement("td");
        $celdaCliente.innerText = pedido.cliente;
        $fila.appendChild($celdaCliente);
        const $celdaDireccion = document.createElement("td");
        $celdaDireccion.innerText = pedido.direccion;
        $fila.appendChild($celdaDireccion);

        // Extraer el id del pedido en el que estamos dentro del ciclo
        const idPedido = pedido.idPedido;
        // Link para editar
        const $linkEditar = document.createElement("a");
        // TODO Crear link a detalles del pedido
        $linkEditar.href = "../html/detalles_pedido.php?id=" + idPedido;
        //$linkEditar.href = "../html/empleado.html";
        $linkEditar.innerHTML = `<i class="fa fa-edit"></i>`;
        $linkEditar.classList.add("button", "is-warning");
        const $celdaLinkEditar = document.createElement("td");
        $celdaLinkEditar.appendChild($linkEditar);
        $fila.appendChild($celdaLinkEditar);

        // Para el botón de eliminar primero creamos el botón, agregamos su listener y luego lo adjuntamos a su celda
        const $botonEliminar = document.createElement("button");
        $botonEliminar.classList.add("button", "is-danger")
        $botonEliminar.innerHTML = `<i class="fa fa-trash"></i>`;
        $botonEliminar.onclick = async() => {

            const respuestaConfirmacion = await Swal.fire({
                title: "Confirmación",
                text: "¿Eliminar el pedido? esto no se puede deshacer",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#3085d6',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
            });
            if (respuestaConfirmacion.value) {
                const url = `../../controladores/eliminar_producto.php?id=${idPedido}`;
                const respuestaRaw = await fetch(url, {
                    method: "DELETE",
                });
                const respuesta = await respuestaRaw.json();
                if (respuesta) {
                    Swal.fire({
                        icon: "success",
                        text: "Pedido eliminado",
                        timer: 700, // <- Ocultar dentro de 0.7 segundos
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        text: "El servidor no respondió con una respuesta exitosa",
                    });
                }
                // De cualquier modo, volver a obtener los pedidos para refrescar la tabla
                obtenerPedidos();
            }
        };
        //const $celdaBoton = document.createElement("td");
        //$celdaBoton.appendChild($botonEliminar);
        //$fila.appendChild($celdaBoton);
        // Adjuntamos la fila a la tabla
        $cuerpoTabla.appendChild($fila);
    }
};

// Y cuando se incluya este script, invocamos a la función
obtenerPedidos();