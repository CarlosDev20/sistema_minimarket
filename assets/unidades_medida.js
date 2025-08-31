
//Modal editar
document.addEventListener("DOMContentLoaded", () => {
    const modalEditar = document.getElementById("modalEditar");
    if (modalEditar) {
        modalEditar.addEventListener("show.bs.modal", function (event) {
            let button = event.relatedTarget; // Botón que disparó el modal
            
            let codigo = button.getAttribute("data-codigo");
            let abreviatura = button.getAttribute("data-abreviatura");
            let descripcion = button.getAttribute("data-descripcion");

            // Insertar datos en los campos del modal
            document.getElementById("editCodigo").value = codigo;
            document.getElementById("editAbreviatura").value = abreviatura;
            document.getElementById("editDescripcion").value = descripcion;
        });
    }
});

//Modal Eliminar
// Espera a que cargue el DOM
document.addEventListener("DOMContentLoaded", () => {
    const modalEliminar = document.getElementById("modalEliminar");
    const codigoSpan = document.getElementById("codigoEliminar");
    const descripcionSpan = document.getElementById("descripcionEliminar");
    const btnConfirmar = document.getElementById("btnConfirmarEliminar");

    // Cuando se abre el modal
    modalEliminar.addEventListener("show.bs.modal", function (event) {
        let button = event.relatedTarget; // Botón que disparó el modal
        let codigo = button.getAttribute("data-codigo");
        let descripcion = button.getAttribute("data-descripcion");

        // Insertar datos en el modal
        codigoSpan.textContent = codigo;
        descripcionSpan.textContent = descripcion;

        // Configurar enlace de confirmación
        btnConfirmar.setAttribute("href", "eliminar_unidades.php?id=" + codigo);
    });
});
