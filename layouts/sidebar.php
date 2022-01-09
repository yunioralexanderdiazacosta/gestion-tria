<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Control TRIA</div>
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
        <i class="fas fa-fw fa-university"></i>
        <span>Periodos</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link <?php if($page_name == 'profesores') echo 'active'; ?>" href="profesores.php">
        <i class="fas fa-fw fa-chalkboard-teacher"></i>
        <span>Profesores</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link <?php if($page_name == 'estudiantes') echo 'active'; ?>" href="estudiantes.php">
        <i class="fas fa-fw fa-user-graduate"></i>
        <span>Estudiantes</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link <?php if($page_name == 'trabajos') echo 'active'; ?>" href="trabajos.php">
        <i class="fas fa-fw fa-user-graduate"></i>
        <span>Trabajos</span></a>
    </li>
</ul>