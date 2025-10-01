
function initInicio() {
    if (window.Chart) {
        let productosCanvas = document.getElementById('productosChart');
        let ventasCanvas = document.getElementById('ventasChart');

        if (productosCanvas) {
            let productosCtx = productosCanvas.getContext('2d');
            new Chart(productosCtx, {
                type: 'bar',
                data: {
                    labels: ['Producto A', 'Producto B', 'Producto C'],
                    datasets: [{
                        label: 'Cantidad en stock',
                        data: [50, 30, 20],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: { 
                    responsive: true, 
                    plugins: { legend: { position: 'top' } }, 
                    scales: { y: { beginAtZero: true } } 
                }
            });
        }

        if (ventasCanvas) {
            let ventasCtx = ventasCanvas.getContext('2d');
            new Chart(ventasCtx, {
                type: 'line',
                data: {
                    labels: ['Enero', 'Febrero', 'Marzo', 'Abril'],
                    datasets: [{
                        label: 'Ventas',
                        data: [1000, 1500, 1200, 1800],
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        tension: 0.4
                    }]
                },
                options: { 
                    responsive: true, 
                    plugins: { legend: { position: 'top' } }, 
                    scales: { y: { beginAtZero: true } } 
                }
            });
        }
    }
}


