
document.addEventListener("DOMContentLoaded", () => {
  const modalFormulario = document.getElementById("modalFormulario");
  const modalTitulo = document.getElementById("modalTitulo");
  const btnGuardar = document.getElementById("btnGuardar");
  const formAccion = document.getElementById("formAccion");
  const formulario = document.querySelector('#modalFormulario form');

  const btnNuevoProducto = document.querySelector('button[data-bs-target="#modalFormulario"]');
  if (btnNuevoProducto) {
    btnNuevoProducto.addEventListener('click', () => {
      formulario.reset();
      modalTitulo.textContent = '📦 Nuevo Producto';
      btnGuardar.textContent = '💾 Guardar';
      btnGuardar.className = 'btn btn-success';
      formAccion.value = 'crear';
      document.getElementById("formCodigo").value = '';
    });
  }

  if (modalFormulario) {
    modalFormulario.addEventListener("show.bs.modal", function (event) {
      const button = event.relatedTarget;
      if (button && button.dataset.accion === 'editar') {
        modalTitulo.textContent = '✏️ Editar Producto';
        btnGuardar.textContent = 'Guardar Cambios';
        btnGuardar.className = 'btn btn-warning';
        formAccion.value = 'editar';

        const producto = JSON.parse(button.dataset.producto);

        document.getElementById("formCodigo").value = producto.codigo_pr;
        document.getElementById("formDescripcion").value = producto.descripcion_pr;
        document.getElementById("formMarca").value = producto.codigo_ma;
        document.getElementById("formUnidad").value = producto.codigo_um;
        document.getElementById("formCategoria").value = producto.codigo_ca;
        document.getElementById("formStockMin").value = producto.stock_min;
        document.getElementById("formStockMax").value = producto.stock_max;
      }
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

      btnConfirmar.setAttribute("href", `producto/eliminar?id=${codigo}`);
    });
  }

  const modalVerStock = document.getElementById("modalVerStock");
  if (modalVerStock) {
    modalVerStock.addEventListener("show.bs.modal", function (event) {
      const button = event.relatedTarget;
      const codigoProducto = button.getAttribute("data-codigo");
      const descripcionProducto = button.getAttribute("data-descripcion");

      const titulo = document.getElementById("stockProductoTitulo");
      const spinner = document.getElementById("stockSpinner");
      const tablaCuerpo = document.getElementById("stockTablaCuerpo");

      titulo.textContent = `Producto: ${descripcionProducto}`;
      spinner.classList.remove('d-none');
      tablaCuerpo.innerHTML = '';

      fetch(`producto/ver_stock?codigo_pr=${codigoProducto}`)
        .then(response => {
          if (!response.ok) {
            throw new Error('Error en la respuesta del servidor');
          }
          return response.json();
        })
        .then(data => {
          spinner.classList.add('d-none');

          if (data.length > 0) {
            data.forEach(item => {
              const fila = `<tr>
                          <td>${item.descripcion_al}</td>
                          <td class="text-end">${parseFloat(item.stock_actual).toFixed(2)}</td>
                          <td class="text-end">${parseFloat(item.pu_compra).toFixed(2)}</td>
                        </tr>`;
              tablaCuerpo.innerHTML += fila;
            });
          } else {
            tablaCuerpo.innerHTML = '<tr><td colspan="3" class="text-center">No hay datos de stock para este producto.</td></tr>';
          }
        })
        .catch(error => {
          spinner.classList.add('d-none');
          tablaCuerpo.innerHTML = '<tr><td colspan="3" class="text-center text-danger">Error al cargar el stock.</td></tr>';
          console.error('Error en la petición fetch:', error);
        });
    });
  }
});