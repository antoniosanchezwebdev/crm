<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
    integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
</script>
<style>
    /* Media Query para ordenadores con pantallas grandes */
    @media (min-width: 600px) {
        .img-fluid {
            max-height: 25% !important;
            max-width: 25% !important;
        }

        li {
            margin-right: 10px;
        }

    }

    /* Media Query para tablets y móviles */
    @media (max-width: 500px) {
        .img-fluid {
            max-height: 50% !important;
            max-width: 50% !important;
        }

        li {
            margin-bottom: 10px;
        }
    }

    body {
        background-color: #d9d9d9;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    @mobile
        <div class="container-fluid">
            <div class="navbar-brand">
                <a href="/../home/"><img class="img-fluid" src="{{ asset('images/logo.png') }}" alt="Logo"></a>
                <button class="navbar-toggler float-end !important" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav justify-content-around w-100 py-2">
                    <li class="nav-item border mx-2" style="border-color: white;">
                        <a class="d-block w-100 p-2" href="/admin/presupuestos">
                            <i class="fas fa-book"></i>
                            <strong>Presupuestos</strong>
                        </a>
                    </li>
                    <li class="nav-item border mx-2" style="border-color: white;">
                        <a class="d-block w-100 p-2" href="/admin/productos">
                            <i class="fas fa-boxes-stacked"></i>
                            <strong>Inventario</strong>
                        </a>
                    </li>
                    <li class="nav-item border mx-2" style="border-color: white;">
                        <a class="btn btn-md btn-outline-light d-block w-100 p-2" href="/admin/orden-trabajo">
                            <i class="fas fa-folder-minus"></i>
                            <strong>Tareas</strong>
                        </a>
                    </li>
                    <li class="nav-item border mx-2" style="border-color: white;">
                        <a class="btn btn-md btn-outline-light d-block w-100 p-2" href="/admin/clients">
                            <i class="fas fa-cart-shopping"></i>
                            <strong>Caja</strong>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    @elsemobile
        <div class="container-fluid col-12">
            <div class="navbar-brand col order-1">
                <a href="/../home/"><img class="img-fluid" src="{{ asset('images/logo.png') }}" alt="Logo"></a>
            </div>
            <ul class="navbar-nav me-auto mb-0 mb-lg-0 col order-2">
                <li class="nav-item">
                    <a class="btn btn-outline-light" href="/admin/presupuestos"> <i class="fas fa-book"></i>
                        <strong>Presupuestos</strong></a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-light" href="/admin/productos"> <i class="fas fa-boxes-stacked"></i>
                        <strong>Inventario</strong></a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-light" href="/admin/orden-trabajo"> <i class="fas fa-folder-minus"></i>
                        <strong>Tareas</strong></a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-light" href="/admin/clients"> <i class="fas fa-cart-shopping"></i>
                        <strong>Caja</strong></a>
                </li>
            </ul>
        </div>
        </div>
    @endmobile
</nav>
