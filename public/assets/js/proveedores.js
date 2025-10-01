
document.addEventListener("DOMContentLoaded", () => {
    const modalFormulario = document.getElementById("modalFormulario");
    const modalTitulo = document.getElementById("modalTitulo");
    const btnGuardar = document.getElementById("btnGuardar");
    const formAccion = document.getElementById("formAccion");
    const formulario = document.querySelector('#modalFormulario form');

    document.querySelector('button[data-bs-target="#modalFormulario"]').addEventListener('click', () => {
        formulario.reset();
        modalTitulo.textContent = '👥 Nuevo Proveedor';
        btnGuardar.textContent = '💾 Guardar';
        btnGuardar.className = 'btn btn-success';
        formAccion.value = 'crear';
        document.getElementById("formCodigo").value = '';
    });

    modalFormulario.addEventListener("show.bs.modal", function (event) {
        const button = event.relatedTarget;
        
        if (button.dataset.accion === 'editar') {
            modalTitulo.textContent = '✏️ Editar Proveedor';
            btnGuardar.textContent = 'Guardar Cambios';
            btnGuardar.className = 'btn btn-warning';
            formAccion.value = 'editar';

            const proveedor = JSON.parse(button.dataset.proveedor);
            
            document.getElementById("formCodigo").value = proveedor.codigo_pv;
            document.getElementById("formTipoDoc").value = proveedor.codigo_tdpc;
            document.getElementById("formNroDoc").value = proveedor.nrodocumento_pv;
            document.getElementById("formRazonSocial").value = proveedor.razon_social_pv;
            document.getElementById("formNombres").value = proveedor.nombres;
            document.getElementById("formApellidos").value = proveedor.apellidos;
            document.getElementById("formSexo").value = proveedor.codigo_sx;
            document.getElementById("formRubro").value = proveedor.codigo_ru;
            document.getElementById("formEmail").value = proveedor.email_pv;
            document.getElementById("formTelefono").value = proveedor.telefono_pv;
            document.getElementById("formMovil").value = proveedor.movil_pv;
            document.getElementById("formDistrito").value = proveedor.codigo_di;
            document.getElementById("formDireccion").value = proveedor.direccion_pv;
            document.getElementById("formObservacion").value = proveedor.observacion_pv;
        }
    });

});