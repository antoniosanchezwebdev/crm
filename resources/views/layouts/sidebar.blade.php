<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">General</li>
                <li>
                    <a href="{{route('home')}}" class="waves-effect @if (Request::is('home')) mm-active @endif">
                        <i class="icon-accelerator"></i>{{-- <span class="badge badge-success badge-pill float-right">9+</span>--}} <span> Dashboard </span>
                    </a>
                </li>
{{--
                <li>
                    <a href="/admin/calendario" class="waves-effect"><i class="icon-calendar"></i><span> Calendario </span></a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="fas fa-chart-bar"></i><span> Resumen <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="/admin/resumen-semanas">Resumen Semanal</a></li>
                        <li><a href="/admin/resumen-mensual">Resumen Mensual</a></li>
                        {{-- <li><a href="email-compose.html">Email Compose</a></li> --}}
                    {{-- </ul>
                </li> --}}

                <li class="menu-title">Administración</li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect @if (Request::is('admin/presupuestos')) mm-active @endif"><i class="ti-book"></i><span> Presupuestos <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu @if (Request::is('admin/presupuestos')) mm-active show @endif">
                        <li @if (Request::is('admin/presupuestos') && $tab == "tab1") class="mm-active" @endif><a href="{{route('presupuestos.index', ['tab' => 'tab1'])}}">Ver presupuestos</a></li>
                        <li @if (Request::is('admin/presupuestos') && $tab == "tab3") class="mm-active" @endif><a href="{{route('presupuestos.index', ['tab' => 'tab3'])}}">Crear presupuesto</a></li>
                        {{-- <li><a href="email-compose.html">Email Compose</a></li> --}}
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect @if (Request::is('admin/productos')) mm-active @endif"><i class="ti-harddrives"></i><span> Inventario <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu @if (Request::is('admin/productos')) mm-active show @endif">
                        <li @if (Request::is('admin/productos') && $tab == "tab1") class="mm-active" @endif><a href="{{route('productos.index', ['tab' => 'tab1'])}}">Ver artículos</a></li>
                        <li @if (Request::is('admin/productos') && $tab == "tab3") class="mm-active" @endif><a href="{{route('productos.index', ['tab' => 'tab3'])}}">Añadir producto</a></li>
                        {{-- <li><a href="email-compose.html">Email Compose</a></li> --}}
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect @if (Request::is('admin/facturas')) mm-active @endif"><i class="ti-credit-card"></i><span> Facturación <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu @if (Request::is('admin/facturas')) mm-active show @endif">
                        <li @if (Request::is('admin/facturas') && $tab == "tab1") class="mm-active" @endif><a href="{{route('facturas.index', ['tab' => 'tab1'])}}">Ver todas</a></li>
                        <li @if (Request::is('admin/facturas') && $tab == "tab3") class="mm-active" @endif><a href="{{route('facturas.index', ['tab' => 'tab3'])}}">Crear factura</a></li>
                        {{-- <li><a href="email-compose.html">Email Compose</a></li> --}}
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect @if (Request::is('admin/orden-trabajo')) mm-active @endif"><i class="ti-car"></i><span> Tareas <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu @if (Request::is('admin/orden-trabajo')) mm-active show @endif">
                        <li @if (Request::is('admin/orden-trabajo') && $tab == "tab1") class="mm-active" @endif><a href="{{route('orden-trabajo.index', ['tab' => 'tab1'])}}">Ver tareas sin asignar</a></li>
                        <li @if (Request::is('admin/orden-trabajo') && $tab == "tab2") class="mm-active" @endif><a href="{{route('orden-trabajo.index', ['tab' => 'tab2'])}}">Ver tareas asignadas</a></li>
                        {{-- <li><a href="email-compose.html">Email Compose</a></li> --}}
                    </ul>
                </li>

                <li>
                    <a href="{{route('informes.index')}}" class="waves-effect @if (Request::is('/informes')) mm-active @endif">
                        <i class="ti-stats-up"></i>
                        {{-- <span class="badge badge-success badge-pill float-right">9+</span> --}}
                        <span> Informes </span>
                    </a>
                </li>


                <li>
                    <a href="javascript:void(0);" class="waves-effect @if (Request::is('admin/caja')) mm-active @endif"><i class="ti-wallet"></i><span> Caja <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu @if (Request::is('admin/caja')) mm-active show @endif">
                        <li @if (Request::is('admin/caja') && $tab == "tab1") class="mm-active" @endif><a href="{{route('caja.index', ['tab' => 'tab1'])}}">Ver movimientos</a></li>
                        <li @if (Request::is('admin/caja') && $tab == "tab2") class="mm-active" @endif><a href="{{route('caja.index', ['tab' => 'tab2'])}}">Hacer movimiento</a></li>
                        {{-- <li><a href="email-compose.html">Email Compose</a></li> --}}
                    </ul>
                </li>


                <li class="menu-title">Personalización</li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect @if (Request::is('admin/clients')) mm-active @endif"><i class="ti-user"></i><span> Clientes <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu @if (Request::is('admin/caja')) mm-active show @endif">
                        <li @if (Request::is('admin/clients') && $tab == "tab1") class="mm-active" @endif><a href="{{route('clients.index', ['tab' => 'tab1'])}}">Ver todos</a></li>
                        <li @if (Request::is('admin/clients') && $tab == "tab2") class="mm-active" @endif><a href="{{route('clients.index', ['tab' => 'tab3'])}}">Añadir cliente</a></li>
                        {{-- <li><a href="email-compose.html">Email Compose</a></li> --}}
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect @if (Request::is('admin/proveedores')) mm-active @endif"><i class="ti-truck"></i><span> Proveedores <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu @if (Request::is('admin/proveedores')) mm-active show @endif">
                        <li @if (Request::is('admin/proveedores') && $tab == "tab1") class="mm-active" @endif><a href="{{route('proveedores.index', ['tab' => 'tab1'])}}">Ver todos</a></li>
                        <li @if (Request::is('admin/proveedores') && $tab == "tab2") class="mm-active" @endif><a href="{{route('proveedores.index', ['tab' => 'tab3'])}}">Añadir proveedor</a></li>
                        {{-- <li><a href="email-compose.html">Email Compose</a></li> --}}
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect @if (Request::is('admin/fabricantes')) mm-active @endif"><i class="ti-package"></i><span> Fabricantes <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu @if (Request::is('admin/fabricantes')) mm-active show @endif">
                        <li @if (Request::is('admin/fabricantes') && $tab == "tab1") class="mm-active" @endif><a href="{{route('fabricantes.index', ['tab' => 'tab1'])}}">Ver todos</a></li>
                        <li @if (Request::is('admin/fabricantes') && $tab == "tab2") class="mm-active" @endif><a href="{{route('fabricantes.index', ['tab' => 'tab3'])}}">Añadir fabricante</a></li>
                        {{-- <li><a href="email-compose.html">Email Compose</a></li> --}}
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect @if (Request::is('admin/trabajadores')) mm-active @endif"><i class="ti-id-badge"></i><span> Trabajadores <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu @if (Request::is('admin/fabricantes')) mm-active show @endif">
                        <li @if (Request::is('admin/trabajadores') && $tab == "tab1") class="mm-active" @endif><a href="{{route('trabajadores.index', ['tab' => 'tab1'])}}">Ver todos</a></li>
                        <li @if (Request::is('admin/trabajadores') && $tab == "tab2") class="mm-active" @endif><a href="{{route('trabajadores.index', ['tab' => 'tab3'])}}">Añadir trabajador</a></li>
                        {{-- <li><a href="email-compose.html">Email Compose</a></li> --}}
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect @if (Request::is('admin/productos-categories')) mm-active @endif"><i class="ti-folder"></i><span> Cats. de artículos <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu @if (Request::is('admin/productos-categories')) mm-active show @endif">
                        <li @if (Request::is('admin/productos-categories') && $tab == "tab1") class="mm-active" @endif><a href="{{route('productos-categories.index', ['tab' => 'tab1'])}}">Ver todas</a></li>
                        <li @if (Request::is('admin/productos-categories') && $tab == "tab2") class="mm-active" @endif><a href="{{route('productos-categories.index', ['tab' => 'tab3'])}}">Añadir categoría</a></li>
                        {{-- <li><a href="email-compose.html">Email Compose</a></li> --}}
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect @if (Request::is('admin/ecotasas')) mm-active @endif"><i class="ti-world"></i><span> Ecotasa <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu @if (Request::is('admin/ecotasas')) mm-active show @endif">
                        <li @if (Request::is('admin/ecotasas') && $tab == "tab1") class="mm-active" @endif><a href="{{route('ecotasa.index', ['tab' => 'tab1'])}}">Ver ecotasas (< 1400mm)</a></li>
                        <li @if (Request::is('admin/ecotasas') && $tab == "tab2") class="mm-active" @endif><a href="{{route('ecotasa.index', ['tab' => 'tab2'])}}">Ver ecotasas (> 1400mm)</a></li>
                        <li @if (Request::is('admin/ecotasas') && $tab == "tab3") class="mm-active" @endif><a href="{{route('ecotasa.index', ['tab' => 'tab3'])}}">Añadir ecotasa</a></li>
                        {{-- <li><a href="email-compose.html">Email Compose</a></li> --}}
                    </ul>
                </li>


                {{-- <li>
                    <a href="/admin/presupuestos" class="waves-effect">
                        <i class="fas fa-hand-holding-usd"></i></i><span> Presupuestos </span>
                    </a>
                </li> --}}


                {{-- <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-paper-sheet"></i><span> Pages <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="pages-pricing.html">Pricing</a></li>
                        <li><a href="pages-invoice.html">Invoice</a></li>
                        <li><a href="pages-timeline.html">Timeline</a></li>
                        <li><a href="pages-faqs.html">FAQs</a></li>
                        <li><a href="pages-maintenance.html">Maintenance</a></li>
                        <li><a href="pages-comingsoon.html">Coming Soon</a></li>
                        <li><a href="pages-starter.html">Starter Page</a></li>
                        <li><a href="pages-login.html">Login</a></li>
                        <li><a href="pages-register.html">Register</a></li>
                        <li><a href="pages-recoverpw.html">Recover Password</a></li>
                        <li><a href="pages-lock-screen.html">Lock Screen</a></li>
                        <li><a href="pages-404.html">Error 404</a></li>
                        <li><a href="pages-500.html">Error 500</a></li>
                    </ul>
                </li> --}}

                {{-- <li class="menu-title">Components</li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-pencil-ruler"></i> <span> UI Elements <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                    <ul class="submenu">
                        <li><a href="ui-alerts.html">Alerts</a></li>
                        <li><a href="ui-badge.html">Badge</a></li>
                        <li><a href="ui-buttons.html">Buttons</a></li>
                        <li><a href="ui-cards.html">Cards</a></li>
                        <li><a href="ui-dropdowns.html">Dropdowns</a></li>
                        <li><a href="ui-navs.html">Navs</a></li>
                        <li><a href="ui-tabs-accordions.html">Tabs &amp; Accordions</a></li>
                        <li><a href="ui-modals.html">Modals</a></li>
                        <li><a href="ui-images.html">Images</a></li>
                        <li><a href="ui-progressbars.html">Progress Bars</a></li>
                        <li><a href="ui-pagination.html">Pagination</a></li>
                        <li><a href="ui-popover-tooltips.html">Popover & Tooltips</a></li>
                        <li><a href="ui-spinner.html">Spinner</a></li>
                        <li><a href="ui-carousel.html">Carousel</a></li>
                        <li><a href="ui-video.html">Video</a></li>
                        <li><a href="ui-typography.html">Typography</a></li>
                        <li><a href="ui-grid.html">Grid</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-diamond"></i> <span> Advanced UI <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                    <ul class="submenu">
                        <li><a href="advanced-alertify.html">Alertify</a></li>
                        <li><a href="advanced-rating.html">Rating</a></li>
                        <li><a href="advanced-nestable.html">Nestable</a></li>
                        <li><a href="advanced-rangeslider.html">Range Slider</a></li>
                        <li><a href="advanced-sweet-alert.html">Sweet-Alert</a></li>
                        <li><a href="advanced-lightbox.html">Lightbox</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-todolist-check"></i><span> Forms <span class="badge badge-pill badge-danger float-right">8</span> </span></a>
                    <ul class="submenu">
                        <li><a href="form-elements.html">Form Elements</a></li>
                        <li><a href="form-validation.html">Form Validation</a></li>
                        <li><a href="form-advanced.html">Form Advanced</a></li>
                        <li><a href="form-editors.html">Form Editors</a></li>
                        <li><a href="form-uploads.html">Form File Upload</a></li>
                        <li><a href="form-mask.html">Form Mask</a></li>
                        <li><a href="form-summernote.html">Summernote</a></li>
                        <li><a href="form-xeditable.html">Form Xeditable</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-graph"></i><span> Charts <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="charts-morris.html">Morris Chart</a></li>
                        <li><a href="charts-chartist.html">Chartist Chart</a></li>
                        <li><a href="charts-chartjs.html">Chartjs Chart</a></li>
                        <li><a href="charts-flot.html">Flot Chart</a></li>
                        <li><a href="charts-c3.html">C3 Chart</a></li>
                        <li><a href="charts-other.html">Jquery Knob Chart</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-spread"></i><span> Tables <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="tables-basic.html">Basic Tables</a></li>
                        <li><a href="tables-datatable.html">Data Table</a></li>
                        <li><a href="tables-responsive.html">Responsive Table</a></li>
                        <li><a href="tables-editable.html">Editable Table</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-coffee"></i> <span> Icons  <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></span> </a>
                    <ul class="submenu">
                        <li><a href="icons-material.html">Material Design</a></li>
                        <li><a href="icons-fontawesome.html">Font Awesome</a></li>
                        <li><a href="icons-outline.html">Outline Icons</a></li>
                        <li><a href="icons-themify.html">Themify Icons</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-map"></i><span> Maps <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="maps-google.html"> Google Map</a></li>
                        <li><a href="maps-vector.html"> Vector Map</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="icon-share"></i><span> Multi Level <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="javascript:void(0);"> Menu 1</a></li>
                        <li>
                            <a href="javascript:void(0);">Menu 2  <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                            <ul class="submenu">
                                <li><a href="javascript:void(0);">Menu 2.1</a></li>
                                <li><a href="javascript:void(0);">Menu 2.1</a></li>
                            </ul>
                        </li>
                    </ul>
                </li> --}}

            </ul>

        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->

<style>

</style>
