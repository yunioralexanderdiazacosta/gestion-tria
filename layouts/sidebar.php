<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <img src="img/logo2.png" width="50">
        <div class="sidebar-brand-text text-dark mx-3"><span class="badge badge-warning">Control TRIA</span></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php if($page_name == 'inicio') echo 'active'; ?>">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Inicio</span></a>
    </li>

    <li class="nav-item <?php if($page_name == 'periodos') echo 'active'; ?>">
        <a class="nav-link" href="periodos.php">
        <i class="fas fa-fw fa-calendar"></i>
        <span>Periodos</span></a>
    </li>

    <li class="nav-item <?php if($page_name == 'profesores') echo 'active'; ?>">
        <a class="nav-link" href="profesores.php">
        <i class="fas fa-fw fa-chalkboard-teacher"></i>
        <span>Profesores</span></a>
    </li>

    <li class="nav-item <?php if($page_name == 'estudiantes') echo 'active'; ?>">
        <a class="nav-link" href="estudiantes.php">
        <i class="fas fa-fw fa-user-graduate"></i>
        <span>Estudiantes</span></a>
    </li>

    <li class="nav-item <?php if($page_name == 'trabajos') echo 'active'; ?>">
        <a class="nav-link" href="trabajos.php">
        <i class="fas fa-fw fa-book"></i>
        <span>Trabajos</span></a>
    </li>
</ul>