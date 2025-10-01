
document.addEventListener("DOMContentLoaded", () => {
    const modalEditar = document.getElementById("modalEditar");
    if (modalEditar) {
        modalEditar.addEventListener("show.bs.modal", function (event) {
            const button = event.relatedTarget;
            const codigo = button.getAttribute("data-codigo");
            const descripcion = button.getAttribute("data-descripcion");
            document.getElementById("editCodigo").value = codigo;
            document.getElementById("editDescripcion").value = descripcion;
        });
    }

    const modalEliminar = document.getElementById("modalEliminar");
    if (modalEliminar) {
        modalEliminar.addEventListener("show.bs.modal", function (event) {
            const button = event.relatedTarget;
            const codigo = button.getAttribute("data-codigo");
            const descripcion = button.getAttribute("data-descripcion");
            const btnConfirmar = document.getElementById("btnConfirmarEliminar");

            document.getElementById("codigoEliminar").textContent = codigo;
            document.getElementById("descripcionEliminar").textContent = descripcion;

            btnConfirmar.setAttribute("href", `categoria/eliminar?id=${codigo}`);
        });
    }
});