const $idProducto = document.querySelector("#idProducto"),
    $producto = document.querySelector("#producto"),
    $material = document.querySelector("#material")

const rellenarDatos = async()=>{
    const urlSearchParams = new URLSearchParams(window.location.search);
    let idProducto = urlSearchParams.get("id"); // <-- Actualizar el ID global
    
    const respuestaRaw = await fetch(`../../controladores/obtener_producto_por_id.php?id=${idProducto}`);
    let producto = await respuestaRaw.json();
    
    $idProducto.value = producto.idProducto
    $producto.value = producto.nombre_producto
    $material.value = producto.nombre_Material
}

rellenarDatos()