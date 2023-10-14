<?php
extract($_REQUEST);
if (!isset($_SESSION['usuario_logueado'])) {
    $is_logged = false;
    $_SESSION['rol'] = 'visitante';
    $rol = $_SESSION['rol'];
} else {
    $is_logged = true;
    $nombre = $_SESSION['nombre'];
    $rol = $_SESSION['rol'];
}
?>


<nav class="navbar navbar-expand-lg navbar-light bg-light shadow mb-5">
    <div class="container">
       

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a href="index.php" class="nav-link link-underline">Inicio</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?categoria=Negocios" class="nav-link">Negocios</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?categoria=Desarrollo tecnologico" class="nav-link">Desarrollo tecnologico</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?categoria=Deportes" class="nav-link">Deportes</a>
                </li>
            </ul>

            <div class="navbar-nav">
                <?php if ($is_logged): ?>
                    <div class="dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <?php if ($rol == "admin"): ?>
                                <img src="../imagenes/logos/user1.png" class="img-fluid" alt="usuario-logo" width="50">
                            <?php else: ?>
                                <img src="../imagenes/logos/user1.png" class="img-fluid" alt="usuario-logo" width="50">
                            <?php endif ?>
                            <?= $nombre ?>
                        </a>
                        <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                            <?php if ($rol == "admin"): ?>
                                <li>
                                    <h6 class="dropdown-header">Panel Admin</h6>
                                </li>
                                <li><a class="dropdown-item" href="../admin/mis_publicaciones.php">Admin usuarios</a></li>
                                <li><a class="dropdown-item" href="../admin/todas_publicaciones.php">Admin Publicaciones</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                            <?php else: ?>
                                <li></li>
                            <?php endif ?>
                            <li>
                                <h6 class="dropdown-header">Panel Autor</h6>
                            </li>
                            <li><a class="dropdown-item" href="../admin/index.php">Mis Publicaciones</a></li>
                            <li><a class="dropdown-item" href="form_agregar.php">Nueva Publicación</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="../backend/logout.php">Cerrar sesión</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="../admin/form_login.php" class="btn btn-outline-dark img-fluid">
                        Ingresar
                    </a>
                    <a class="nav-link text-center link-primary" href="../admin/agregar_usuario.php">Quiero ser autor</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>