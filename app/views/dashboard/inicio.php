
<div class="container-fluid">

    <div class="row gy-4 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="card text-white bg-primary shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-0">Productos</h5>
                        <p class="card-text fs-4">150</p>
                    </div>
                    <i class="bi bi-basket fs-1"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-0">Ventas Hoy</h5>
                        <p class="card-text fs-4">$1,230</p>
                    </div>
                    <i class="bi bi-cash-coin fs-1"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card text-white bg-warning shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-0">Nuevos Clientes</h5>
                        <p class="card-text fs-4">8</p>
                    </div>
                    <i class="bi bi-person-plus fs-1"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card text-white bg-danger shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-0">Stock Bajo</h5>
                        <p class="card-text fs-4">5</p>
                    </div>
                    <i class="bi bi-exclamation-triangle fs-1"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row gy-4">
        <div class="col-lg-6">
            <div class="card p-3 shadow-sm">
                <h5 class="card-title">Productos en Stock</h5>
                <div class="card-body">
                    <canvas id="productosChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card p-3 shadow-sm">
                <h5 class="card-title">Ventas Mensuales</h5>
                <div class="card-body">
                    <canvas id="ventasChart"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function(){
        initInicio();
    });
</script>

