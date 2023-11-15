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
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1em;
        }

        section {
            padding: 20px;
            margin: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1em;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        body {
            background-color: #f8d7da; /* Color rosa claro de fondo */
        }
        .circle-container {
            display: flex;
            align-items: center;
        }

        .circle {
            width: 20px;
            height: 20px;
            background-color: green;
            border-radius: 50%;
            margin-right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 10px;
            font-weight: bold;
        }
        .circle1 {
            width: 20px;
            height: 20px;
            background-color: orange;
            border-radius: 50%;
            margin-right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 10px;
            font-weight: bold;
        }
        .circle2 {
            width: 20px;
            height: 20px;
            background-color: purple;
            border-radius: 50%;
            margin-right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 10px;
            font-weight: bold;
        }
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
                                    WHERE u.Usuario = '$miDato' and p.estado = 'trabajo.php'and (a.tipo = 'Por hacer' or a.tipo = 'Haciendose' );;";

                            $result = $conexion->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<li class="list-group-item">
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalmostra' . $row['id'] . '">
                                                ' . $row['contenido'] . '
                                            </a>
                                        </li>';
                                }
                            } else {
                                echo "";
                            }
                        } else {
                            echo 'No hay dato en la sesión';
                        }

                        $conexion->close();
                        ?>
                        </ul>
                        
                    </li>
                    <li class="nav-item dropdown" onmouseover="showDropdown('dropdown-menu-dropdown')" onmouseout="hideDropdown('dropdown-menu-dropdown')" style="margin-left: 40%;">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Usuario
                    </a>
                    <ul id="dropdown-menu-configuracion" class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalCambiar">
                                configuracion
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../paginas/inicio.html">Cerrar Sesión</a></li>
                    </ul>

                    <div class="modal fade" id="modalCambiar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    <main>
        <header  style="background-color:#bb6190;">
        <?php
            include 'conexion.php';
            if (isset($_SESSION['DatoP']) && is_scalar($_SESSION['DatoP'])) {
                $DatoP = $_SESSION['DatoP'];
                $sql = "SELECT * FROM Proyecto WHERE id = '$DatoP';";
                $result = $conexion->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<h1>'. $row['nombre'] .'</h1>';
                    }
                } else {
                    echo "No se encontró el proyecto con el ID: $DatoP";
                }
            } else {
                echo 'No hay dato en la sesión';
            }
        ?>

        </header>
        <footer style="background-color: #D877A9;">
            <p style="color: aliceblue">&copy; 2023 Hit-Hab, Inc.</p>
        </footer>
        <section class="project-details">
            <h2>Descripcion</h2>
            <?php
            include 'conexion.php';
            if (isset($_SESSION['DatoP']) && is_scalar($_SESSION['DatoP'])) {
                $miDato = $_SESSION['DatoP'];
                $sql = "SELECT * FROM Proyecto WHERE id = '$miDato';";
                $result = $conexion->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<p>'. $row['descripcion'] .'</p>';
                    }
                } else {
                    echo "No se encontró el proyecto con el ID: $DatoP";
                }
            } else {
                echo 'No hay dato en la sesión';
            }
            ?>
            <button onclick="showConfig('config')">Configuración del Proyecto</button>
            <button onclick="showConfig('members')">Integrantes del Proyecto</button>
            <button onclick="showConfig('activities')">División de Actividades</button>

            <div id="config" style="display: none;">
            <?php
                include 'conexion.php';
                if (isset($_SESSION['DatoP']) && is_scalar($_SESSION['DatoP'])) {
                    $DatoP = $_SESSION['DatoP'];
                    $sql = "SELECT * FROM Proyecto WHERE id = '$DatoP';";
                    $result = $conexion->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '
                            <div class="card" style="background-color: #D877A9;">
                                <div class="card-header">
                                    '. $row['nombre'] .'
                                </div>
                                <div class="card-body">
                                    <blockquote class="blockquote mb-0">
                                    <p>'. $row['descripcion'] .'</p>
                                    <a href="borrarProyecto.php">Borrar</a>
                                    <br>  
                                    <a href="terminarProyecto.php">Terminar</a>
                                    </blockquote>
                                </div>
                            </div>
                            ';
                        }
                    } else {
                        echo "No se encontró el proyecto con el ID: $DatoP";
                    }
                } else {
                    echo 'No hay dato en la sesión';
                }
            ?>
            </div>

            <div id="members" style="display: none;">
            <div class="row">
                <div class="col">
                <div class="card">
                    <div class="card-header">
                        Integrantes
                    </div>
                    <ul class="list-group list-group-flush">
                    <?php
                    include 'conexion.php';
                    if (isset($_SESSION['DatoP']) && is_scalar($_SESSION['DatoP'])) {
                        $DatoP = $_SESSION['DatoP'];
                        $sql = "SELECT u.* FROM Usuario u
                                INNER JOIN Integrantes i ON u.id = i.id_Usuario
                                WHERE i.id_Proyecto = '$DatoP'
                                order by i.id;";
                        $result = $conexion->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<li class="list-group-item">'. $row['Usuario'] .'</li>';
                            }
                        } else {
                            echo "No se encontró el proyecto con el ID: $DatoP";
                        }
                    } else {
                        echo 'No hay dato en la sesión';
                    }
                    ?>

                    <?php
                    include 'conexion.php';
                    if (isset($_SESSION['miDato']) && is_scalar($_SESSION['miDato'])) {
                        $miDato = $_SESSION['miDato'];
                        $sql = "SELECT i.*, u.* FROM Usuario u
                                INNER JOIN Integrantes i ON u.id = i.id_Usuario
                                WHERE u.Usuario = '$miDato' AND i.rol = 'Fundador' AND id_Proyecto = '$DatoP';";
                        $result = $conexion->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarIntegrante">
                                Ingresar
                                </button>';
                            }
                        } else {
                            echo "";
                        }
                    } else {
                        echo 'No hay dato en la sesión';
                    }
                    ?>
                        <div class="modal fade" id="modalAgregarIntegrante" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Agregar Integrante</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <form action="Integrante.php" method="post">
                                        <div class="mb-3">
                                            <label for="usuario_o_email" class="form-label">Usuario o Correo Electrónico:</label>
                                            <input type="text" class="form-control" id="usuario_o_email" name="usuario_o_email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="rol" class="form-label">Rol del Usuario:</label>
                                            <input type="text" class="form-control" id="rol" name="rol" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Agregar Integrante</button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </ul>
                </div>
                </div>
                <div class="col">
                <div class="card" >
                    <div class="card-header">
                        Rol
                    </div>
                    <ul class="list-group list-group-flush">
                    <?php
                    include 'conexion.php';
                    if (isset($_SESSION['DatoP']) && is_scalar($_SESSION['DatoP'])) {
                        $DatoP = $_SESSION['DatoP'];
                        $sql = "SELECT i.* FROM Usuario u
                                INNER JOIN Integrantes i ON u.id = i.id_Usuario
                                WHERE i.id_Proyecto = '$DatoP' 
                                order by i.id;";
                        $result = $conexion->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<li class="list-group-item">'. $row['rol'] .'</li>';
                            }
                        } else {
                            echo "";
                        }
                    } else {
                        echo 'No hay dato en la sesión';
                    }
                    ?>
                    </ul>
                </div>
                </div>
            </div>
            </div>

            <div id="activities" style="display: none;">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <div class="circle-container">
                                    <div class="circle"></div>
                                    <span>Por hacer</span>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush">
                            <?php
                            include 'conexion.php';

                            if (isset($_SESSION['DatoP']) && is_scalar($_SESSION['DatoP'])) {
                                $miDato = $_SESSION['DatoP'];
                                $sql = "SELECT * FROM Actividade WHERE id_Proyecto = '$miDato' AND tipo = 'Por hacer';";
                                $result = $conexion->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<li class="list-group-item">
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalCambiarHaciendoce' . $row['id'] . '">
                                                    ' . $row['contenido'] . '
                                                </a>
                                            </li>';

                                        echo '<div class="modal fade" id="modalCambiarHaciendoce' . $row['id'] . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p><strong>Tipo:</strong>' . $row['tipo'] . '</p>
                                                                <p><strong>Contenido:</strong>' . $row['contenido'] . '</p>
                                                                <p><strong>Fecha de Entrega:</strong>' . $row['fecha'] . '</p>';

                                                                $sql1 = "SELECT u.Usuario
                                                                        FROM Actividade a
                                                                        INNER JOIN Integrantes i ON a.id_intgrante = i.id
                                                                        INNER JOIN Usuario u ON i.id_Usuario = u.id
                                                                        WHERE a.id = '" . $row['id'] . "';";
                                                                $result1 = $conexion->query($sql1);

                                                                if ($result1->num_rows > 0) {
                                                                    while ($row1 = $result1->fetch_assoc()) {
                                                                        echo '<p><strong>Usuario:</strong>' . $row1['Usuario'] . '</p>';
                                                                    }
                                                                } else {
                                                                    echo "No se encontró el proyecto con el ID: $DatoP";
                                                                }

                                                        echo   '<form action="cambiarAhaciendo.php" method="post">
                                                                    <input type="hidden" name="id_actividad" value="' . $row['id'] . '">
                                                                    <button type="submit" class="btn btn-success">Marcar como Haciéndose</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';
                                    }
                                } else {
                                    echo "No se encontró el proyecto con el ID: $DatoP";
                                }
                            } else {
                                echo 'No hay dato en la sesión';
                            }
                            ?>
                             
                            <?php
                                include 'conexion.php';
                                if (isset($_SESSION['miDato']) && is_scalar($_SESSION['miDato'])) {
                                    $miDato = $_SESSION['miDato'];
                                    $sql = "SELECT i.*, u.* FROM Usuario u
                                            INNER JOIN Integrantes i ON u.id = i.id_Usuario
                                            WHERE u.Usuario = '$miDato' AND i.rol = 'Fundador' AND id_Proyecto = '$DatoP';";
                                    $result = $conexion->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarActividad">
                                            Ingresar
                                            </button>';
                                        }
                                    } else {
                                        echo "";
                                    }
                                } else {
                                    echo 'No hay dato en la sesión';
                                }
                            ?>
                            

                                <div class="modal fade" id="modalAgregarActividad" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Agregar Actividad</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <form action="ActividadPorhacer.php" method="post">
                                                <label for="contenido">Contenido:</label>
                                                <input type="text" id="contenido" name="contenido" required>

                                                <label for="fecha">Fecha de Entrega:</label>
                                                <input type="date" id="fecha" name="fecha" required>

                                                <label for="integrante">Integrante Asignado:</label>
                                                <!-- Aquí puedes poblar el dropdown con los integrantes disponibles -->
                                                <select id="integrante" name="integrante" required>
                                                    <?php
                                                    include 'conexion.php';
                                                    if (isset($_SESSION['miDato']) && is_scalar($_SESSION['miDato'])) {
                                                        $miDato = $_SESSION['miDato'];
                                                        $sql = "SELECT i.id, u.Usuario FROM Usuario u
                                                                INNER JOIN Integrantes i ON u.id = i.id_Usuario
                                                                WHERE id_Proyecto = '$DatoP';";
                                                        $result = $conexion->query($sql);
                                                        if ($result->num_rows > 0) {
                                                            while ($row = $result->fetch_assoc()) {
                                                                echo '<option value="'.$row['id'].'">'. $row['Usuario'] .'</option>';
                                                            }
                                                        } else {
                                                            echo "";
                                                        }
                                                    } else {
                                                        echo 'No hay dato en la sesión';
                                                    }
                                                    ?>
                                                </select>

                                                <button type="submit">Agregar Actividad</button>
                                            </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <div class="circle-container">
                                    <div class="circle1"></div>
                                    <span>Haciendose</span>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush">
                            <?php
                            include 'conexion.php';
                            if (isset($_SESSION['DatoP']) && is_scalar($_SESSION['DatoP'])) {
                                $miDato = $_SESSION['DatoP'];
                                $sql = "SELECT * FROM Actividade WHERE id_Proyecto = '$miDato' AND tipo = 'Haciendose';";
                                $result = $conexion->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<li class="list-group-item">
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalCambiarEcho' . $row['id'] . '">
                                                 ' . $row['contenido'] . '
                                                </a>
                                        </li>';

                                        echo '<div class="modal fade" id="modalCambiarEcho' . $row['id'] . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p><strong>Tipo:</strong>' . $row['tipo'] . '</p>
                                                                <p><strong>Contenido:</strong>' . $row['contenido'] . '</p>
                                                                <p><strong>Fecha de Entrega:</strong>' . $row['fecha'] . '</p>';

                                                                $sql1 = "SELECT u.Usuario
                                                                        FROM Actividade a
                                                                        INNER JOIN Integrantes i ON a.id_intgrante = i.id
                                                                        INNER JOIN Usuario u ON i.id_Usuario = u.id
                                                                        WHERE a.id = '" . $row['id'] . "';";
                                                                $result1 = $conexion->query($sql1);

                                                                if ($result1->num_rows > 0) {
                                                                    while ($row1 = $result1->fetch_assoc()) {
                                                                        echo '<p><strong>Usuario:</strong>' . $row1['Usuario'] . '</p>';
                                                                    }
                                                                } else {
                                                                    echo "No se encontró el proyecto con el ID: $DatoP";
                                                                }

                                                        echo   '<form action="cambiarAecho.php" method="post">
                                                                    <input type="hidden" name="id_actividad" value="' . $row['id'] . '">
                                                                    <button type="submit" class="btn btn-success">Marcar como echo</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>';
                                            }
                                        } else {
                                            echo "No se encontró el proyecto con el ID: $DatoP";
                                        }
                                    } else {
                                        echo 'No hay dato en la sesión';
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <div class="circle-container">
                                    <div class="circle2"></div>
                                    <span>Echo</span>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush">
                            <?php
                            include 'conexion.php';
                            if (isset($_SESSION['DatoP']) && is_scalar($_SESSION['DatoP'])) {
                                $miDato = $_SESSION['DatoP'];
                                $sql = "SELECT * FROM Actividade WHERE id_Proyecto = '$miDato' AND tipo = 'echo';";
                                $result = $conexion->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<li class="list-group-item">
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalCambiarEcho' . $row['id'] . '">
                                         ' . $row['contenido'] . '
                                        </a>
                                </li>';

                                echo '<div class="modal fade" id="modalCambiarEcho' . $row['id'] . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <p><strong>Tipo:</strong>' . $row['tipo'] . '</p>
                                                        <p><strong>Contenido:</strong>' . $row['contenido'] . '</p>
                                                        <p><strong>Fecha de Entrega:</strong>' . $row['fecha'] . '</p>';

                                                        $sql1 = "SELECT u.Usuario
                                                                FROM Actividade a
                                                                INNER JOIN Integrantes i ON a.id_intgrante = i.id
                                                                INNER JOIN Usuario u ON i.id_Usuario = u.id
                                                                WHERE a.id = '" . $row['id'] . "';";
                                                        $result1 = $conexion->query($sql1);

                                                        if ($result1->num_rows > 0) {
                                                            while ($row1 = $result1->fetch_assoc()) {
                                                                echo '<p><strong>Usuario:</strong>' . $row1['Usuario'] . '</p>';
                                                            }
                                                        } else {
                                                            echo "No se encontró el proyecto con el ID: $DatoP";
                                                        }

                                                        echo   '
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                                    }
                                } else {
                                    echo "No se encontró el proyecto con el ID: $DatoP";
                                }
                            } else {
                                echo 'No hay dato en la sesión';
                            }
                        ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        function showConfig(section) {
            hideAllConfig();
            var configSection = document.getElementById(section);
            configSection.style.display = 'block';
        }

        function hideAllConfig() {
            var configSections = document.querySelectorAll('.project-details > div');
            configSections.forEach(function (section) {
                section.style.display = 'none';
            });
        }
    </script>
    </body>
</html>