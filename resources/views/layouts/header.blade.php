<style>

/* Media Query para ordenadores con pantallas grandes */
@media (min-width: 600px) {
    .img-fluid {
        max-height: 15% !important ;
        max-width: 15% !important ;
    }

    li{
    margin-right:10px;
    }

}

    /* Media Query para tablets y móviles */
    @media (max-width: 500px) {
        .img-fluid {
        max-height: 30% !important ;
        max-width: 30% !important ;
    }

    li{
    margin-bottom:10px;
     }
 }

 
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <div class="navbar-brand">
            <a href="/../home/"><img class="img-fluid" src="{{ asset('images/logo_formal_fondo_negro.png') }}" alt="Logo"></a>
      <button class="navbar-toggler float-end !important" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-0 mb-lg-0">
          <li class="nav-item">
            <a class="btn btn-outline-primary" href="/admin/presupuestos"> <i class="fas fa-book"></i> Presupuestos</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-primary" href="/admin/clients"> <i class="fas fa-boxes-stacked"></i> Informes</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-primary" href="/admin/productos"> <i class="fas fa-folder-minus"></i> Inventario</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-primary" href="/admin/clients"> <i class="fas fa-cart-shopping"></i> Caja</a>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>