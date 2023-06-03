
const obtenerMateriales = async () => {
    // Es una petición GET, no necesitamos indicar el método ni el cuerpo
    const respuestaRaw = await fetch("../../controladores/obtener_materiales.php");
    const materiales = await respuestaRaw.json();
    let items_material = []
    for (const material of materiales) {
        items_material.push('<option value="'+material.idMaterial+'">'+material.nombre_Material+'</option>')
    }
    $('#materiales_lista').append(items_material.join(''))
}

function getNumMaterial(){
    console.log(document.querySelector('#materiales_lista').selecselectedIndex)
    let selection = document.querySelector('#materiales_lista')

    document.querySelector('#idMat').value = selection[selection.selectedIndex].value
}

$(document).ready(function (){
   obtenerMateriales();
})

