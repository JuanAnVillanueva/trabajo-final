<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../styles/bandejaTraba.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 20px;
        }

        .form-container {
            max-width: 400px;
            margin: 20px auto;
            background-color: rgba(216, 119, 169, 0.7); /* Color de fondo con transparencia */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            background-color: transparent; /* Hacer que el formulario sea transparente */
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }


    </style>
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
                                    $sql = "SELECT u.id, a.tipo 
                                            FROM Actividade a 
                                            INNER JOIN Integrantes i ON a.id_intgrante = i.id 
                                            INNER JOIN Usuario u ON i.id_Usuario = u.id 
                                            WHERE u.Usuario = '$miDato' 
                                            GROUP BY u.id;";
                                    $result = $conexion->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<li><a class="dropdown-item" href="#">' . $row['tipo'] . '</a></li>';
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
    </head>
    <body>
    <section class="form-container">
        <h2>Crear Proyecto</h2>
        <form action="guardarDato.php" method="post">
            <div class="form-group">
                <label for="nombre">Nombre del Proyecto:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>

            <div class="form-group">
                <label for="fecha_ini">Fecha de Inicio:</label>
                <input type="date" id="fecha_ini" name="fecha_ini" required>
            </div>

            <div class="form-group">
                <label for="fecha_fin">Fecha de Fin:</label>
                <input type="date" id="fecha_fin" name="fecha_fin" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <input type="submit" value="Crear Proyecto">
            </div>
        </form>
    </section>
    </body>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <footer style="background:#D877A9; text-align: center; padding: 10px;" >
        <div class="container">
            <p style="color: aliceblue">&copy; 2023 Hit-Hab, Inc.</p>
        </div>
    </footer> 
</body>
</html>