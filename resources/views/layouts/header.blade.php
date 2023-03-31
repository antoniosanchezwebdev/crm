<style>

/* Media Query para ordenadores con pantallas grandes */
@media (min-width: 600px) {
    .img-fluid {
        max-height: 25% !important ;
        max-width: 25% !important ;
    }

    li{
    margin-right:10px;
    }

}

    /* Media Query para tablets y móviles */
    @media (max-width: 500px) {
        .img-fluid {
        max-height: 50% !important ;
        max-width: 50% !important ;
    }

    li{
    margin-bottom:10px;
     }
 }

 
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
  @mobile
    <div class="container-fluid">
        <div class="navbar-brand">
            <a href="/../home/"><img class="img-fluid" src="{{ asset('images/logo.png') }}" alt="Logo"></a>
      <button class="navbar-toggler float-end !important" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
        </div>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-0 mb-lg-0">
          <li class="nav-item">
            <a class="btn btn-outline-primary" href="/admin/presupuestos"> <i class="fas fa-book"></i> <strong>Presupuestos</strong></a>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-primary" href="/admin/clients"> <i class="fas fa-boxes-stacked"></i> <strong>Informes</strong></a>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-primary" href="/admin/productos"> <i class="fas fa-folder-minus"></i> <strong>Inventario</strong></a>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-primary" href="/admin/clients"> <i class="fas fa-cart-shopping"></i> <strong>Caja</strong></a>
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
          <a class="btn btn-outline-primary" href="/admin/presupuestos"> <i class="fas fa-book"></i> <strong>Presupuestos</strong></a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-primary" href="/admin/clients"> <i class="fas fa-boxes-stacked"></i> <strong>Informes</strong></a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-primary" href="/admin/productos"> <i class="fas fa-folder-minus"></i> <strong>Inventario</strong></a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-primary" href="/admin/clients"> <i class="fas fa-cart-shopping"></i> <strong>Caja</strong></a>
        </li>
      </ul>
    </div>
  </div>
  @endmobile
  </nav>