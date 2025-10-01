
document.addEventListener("DOMContentLoaded", () => {
    const modalFormulario = document.getElementById("modalFormulario");
    const modalTitulo = document.getElementById("modalTitulo");
    const btnGuardar = document.getElementById("btnGuardar");
    const formAccion = document.getElementById("formAccion");
    const formulario = document.querySelector('#modalFormulario form');

    document.querySelector('button[data-bs-target="#modalFormulario"]').addEventListener('click', () => {
        formulario.reset();
        modalTitulo.textContent = '📍 Nueva Provincia';
        btnGuardar.textContent = '💾 Guardar';
        btnGuardar.className = 'btn btn-success';
        formAccion.value = 'crear';
        document.getElementById("formCodigo").value = '';
    });

    modalFormulario.addEventListener("show.bs.modal", function (event) {
        const button = event.relatedTarget;
        if (button.dataset.accion === 'editar') {
            modalTitulo.textContent = 'Editar Provincia';
            btnGuardar.textContent = 'Guardar Cambios';
            btnGuardar.className = 'btn btn-warning';
            formAccion.value = 'editar';

            const provincia = JSON.parse(button.dataset.provincia);
            
            document.getElementById("formCodigo").value = provincia.codigo_po;
            document.getElementById("formDescripcion").value = provincia.descripcion_po;
            document.getElementById("formDepartamento").value = provincia.codigo_de;
        }
    });

    const modalEliminar = document.getElementById("modalEliminar");
    if (modalEliminar) {
        modalEliminar.addEventListener("show.bs.modal", function (event) {
            const button = event.relatedTarget;
            const codigo = button.getAttribute("data-codigo");
            const descripcion = button.getAttribute("data-descripcion");
            const btnConfirmar = document.getElementById("btnConfirmarEliminar");

            document.getElementById("codigoEliminar").textContent = codigo;
            document.getElementById("descripcionEliminar").textContent = descripcion;
            
            btnConfirmar.setAttribute("href", `provincia/eliminar?id=${codigo}`);
        });
    }
});