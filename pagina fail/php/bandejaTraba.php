<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../styles/bandejaTraba.css">
    <title>Document</title>
    <style>
    </style>
</head>
<body>
    <head>
    <nav class="navbar navbar-expand-lg bg-body-tertiary" id="nav" style="background: linear-gradient(90deg, #D877A9 0%, #D877A9 35%, #D877A9 100%);">
        <div class="container-fluid">
            <a href="bandejatraba.php">
                <img src="../img/logo.png" alt="" style="height:90px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown" onmouseover="showDropdown('dropdown-menu-actividades')" onmouseout="hideDropdown('dropdown-menu-actividades')" style="margin-left:250%;">
                        <a class="nav-link" href="#" style="margin-left: 60%;">Actividades</a>
                        <ul id="dropdown-menu-actividades" class="dropdown-menu" style="margin-left: 10%;">
                            <?php
                                session_start();
                                include 'conexion.php';
                                if (isset($_SESSION['miDato']) && is_scalar($_SESSION['miDato'])) {
                                    $miDato = $_SESSION['miDato'];
                                    $sql = "SELECT u.id, a.* 
                                        FROM Actividade a
                                        INNER JOIN Integrantes i ON a.id_intgrante = i.id
                                        INNER JOIN Usuario u ON i.id_Usuario = u.id
                                        INNER JOIN Proyecto p ON a.id_Proyecto = p.id
                                        WHERE u.Usuario = '$miDato' and p.estado = 'trabajo.php'and (a.tipo = 'Por hacer' or a.tipo = 'Haciendose' );";
                                    $result = $conexion->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<li><a class="dropdown-item" href="#">' . $row['contenido'] . '</a></li>';
                                        }
                                    } else {
                                        echo "";
                                    }
                                } else {
                                    echo "";
                                }
                                ?>
                        </ul>
                    </li>
                    <li class="nav-item dropdown" onmouseover="showDropdown('dropdown-menu-dropdown')" onmouseout="hideDropdown('dropdown-menu-dropdown')" style="margin-left: 40%;">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Usuario
                    </a>
                    <ul id="dropdown-menu-configuracion" class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalAgregarIntegrante">
                                configuracion
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../paginas/inicio.html">Cerrar Sesión</a></li>
                    </ul>

                    <div class="modal fade" id="modalAgregarIntegrante" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cambio de nombre</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="ActualizarUsu.php" method="post">
                                        <div class="mb-3">
                                            <label for="nombre" class="form-label">Nuevo nombre</label>
                                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="contraseña" class="form-label">Nueva contraseña</label>
                                            <input type="password" class="form-control" id="contraseña" name="contraseña" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Agregar Canbios</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                        </ul>
                    </li>
                </ul>

                <div class="search-container">
                    <input type="text" id="searchInput" placeholder="Buscar proyectos...">
                    <button onclick="search()">Buscar</button>
                </div>
            </div>
        </div>
    </nav>
    <script>
        function showDropdown(elementId) {
            var dropdownMenu = document.getElementById(elementId);
            dropdownMenu.style.display = 'block';
        }

        function hideDropdown(elementId) {
            var dropdownMenu = document.getElementById(elementId);
            dropdownMenu.style.display = 'none';
        }
    </script>
        </head>
    <body>
        <div class="row" >
            <div class="col" id="pepe"style="background-color: #945F79; color: aliceblue; width: 30srem;" >
            <div class="card" style="width: 18rem;background-color: #945F79; color: aliceblue; ">
                <ul class="list-group list-group-flush">
                    <br>
                    <script>
                        function redireccionar() {
                            // Redirecciona a CrearProyecto.php
                            window.location.href = 'CrearProyecto.php';
                        }
                    </script>
                    <h5 class="card-title">Proyectos <button class="votar-btn" onclick="redireccionar()">+</button></h5>
                    <br>
                    <?php
                        include 'conexion.php';
                        $miDato = $_SESSION['miDato'];
                        if (isset($miDato)) {
                            $sql = "SELECT p.*
                                    FROM Usuario u
                                    INNER JOIN Integrantes i ON u.id = i.id_Usuario
                                    INNER JOIN Proyecto p ON i.id_Proyecto = p.id
                                    WHERE u.Usuario = '$miDato';";

                            $result = $conexion->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $idProyecto = $row['id'];
                                    $_SESSION['DatoP'] = $idProyecto;
                                    echo '<li><a class="dropdown-item" href="'.$row['estado'].'">' . $row['nombre'] . '</a></li>
                                    <br>';
                                }
                            } else {
                                echo "<br>";
                            }
                        }
                    ?>

                    
                </ul>
            </div>
            </div>
            <div class="col">
                <div class="card" >
                    <ul class="list-group list-group-flush">
                        <br>
                        <section>
                            <h5 class="card-title" style="margin-left: 30%;">Novedades de la Actualización</h5>
                        </section>
                        <br>
                        <li class="list-group-item">
                            <div class="card" style="width: 40rem;background-color: #FFB1D9;">
                                <div class="card-body">
                                    <h5 class="card-title">Actualizaciones del feed de tu página de inicio</h5>
                                    <p class="card-text">Hemos combinado el poder del feed, siguiendo con el feed. Para</p>
                                    <p class="card-text">ti para que haya un lugar para descubrir contenido en GitHub.</p>
                                    <p class="card-text">Hay un filtrado mejorado para que puedas personalizar tu feed</p>
                                    <p class="card-text">exactamente como te gusta y un nuevo y brillante diseño visual</p>
                                </div>
                            </div>
                        </li>
                        <br>
                        <li class="list-group-item">
                            <div class="card" style="width:40rem;background-color: #FFB1D9;">
                                <div class="card-body">
                                    <h5 class="card-title">Mejoras al comando de chat /tests en Visual Studio</h5>
                                    <p class="card-text">El comando de barra diagonal /test ahora detecta mejor el marco</p>
                                    <p class="card-text">de prueba que está utilizando y generará nuevas pruebas con el</p>
                                    <p class="card-text">mismo estilo, disponible con la extensión Hit-hab Copilot Chat</p>
                                    <p class="card-text">para Visual Studio, ahora en versión beta.</p>
                                </div>
                            </div>
                        </li>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col">
                <br>
                <br>
                <div class="card" >
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <footer style="background:#D877A9; text-align: center; padding: 10px;" >
        <div class="container">
            <p style="color: aliceblue">&copy; 2023 Hit-Hab, Inc.</p>
        </div>
    </footer> 
</body>
</html>