
// Modal Editar Marcas
document.addEventListener("DOMContentLoaded", () => {
    const modalEditar = document.getElementById("modalEditar");
    if (modalEditar) {
        modalEditar.addEventListener("show.bs.modal", function (event) {
            let button = event.relatedTarget; // Botón que disparó el modal
            
            let codigo = button.getAttribute("data-codigo");
            let descripcion = button.getAttribute("data-descripcion");
            let estado = button.getAttribute("data-estado");

            // Insertar datos en los campos del modal
            document.getElementById("editCodigo").value = codigo;
            document.getElementById("editDescripcion").value = descripcion;
            document.getElementById("editEstado").value = estado;
        });
    }
});

// Modal Eliminar Marcas
document.addEventListener("DOMContentLoaded", () => {
    const modalEliminar = document.getElementById("modalEliminar");
    const codigoSpan = document.getElementById("codigoEliminar");
    const descripcionSpan = document.getElementById("descripcionEliminar");
    const btnConfirmar = document.getElementById("btnConfirmarEliminar");

    if (modalEliminar) {
        modalEliminar.addEventListener("show.bs.modal", function (event) {
            let button = event.relatedTarget; // Botón que disparó el modal
            let codigo = button.getAttribute("data-codigo");
            let descripcion = button.getAttribute("data-descripcion");

            // Insertar datos en el modal
            codigoSpan.textContent = codigo;
            descripcionSpan.textContent = descripcion;

            // Configurar enlace de confirmación
            btnConfirmar.setAttribute("href", "eliminar_marcas.php?id=" + codigo);
        });
    }
});
