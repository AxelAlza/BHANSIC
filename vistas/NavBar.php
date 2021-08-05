<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <a class="navbar-brand" href="/vistas/Inicio.html">BHANSIC</a>
    <button aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarNavDropdown" data-toggle="collapse" type="button">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link">Chat</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Perfil">Perfil</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Consultas
                </a> 
                <ul class="dropdown-menu" id="Dropdown" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="/ListaConsultas">Mis consultas</a></li>
                    <?php if ($_SESSION['USER']->Tipo == "0"):?>
                        <li><a class="dropdown-item" href="/NuevaConsulta">Nueva Consulta</a></li>
                    <?php endif; ?>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Desloguearse">Desloguearse</a>
            </li>
        </ul>
    </div>
</nav>