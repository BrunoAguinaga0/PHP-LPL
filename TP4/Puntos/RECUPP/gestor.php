<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Tareas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Gestor de Tareas</h1>
    </header>
    <section>
        <article>
            <?php
            if (!isset($_COOKIE["usuario"])) {
                header("Location: index.php");
                exit();
            }
            if (isset($_POST["cerrar_sesion"])) {
                setcookie("usuario", "", time() - 3600);
                header("Location: index.php");
                exit();
            }
            $usuario = $_COOKIE["usuario"];
            ?>
            <h2>Usuario: <?php echo $usuario ?></h2>
            <form action="gestor.php" method="post">
                <input type="text" required name="tarea" placeholder="Nueva Tarea" />
                <button type="submit" name="agregar">Agregar Tarea</button>
            </form>
            <form action="gestor.php" method="post">
                <button type="submit" name="limpiar">Limpiar Tareas</button>
            </form>
            <?php
            $tareasPendientes = array();
            $tareasIniciadas = array();
            $tareasTerminadas = array();
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["agregar"])) {
                $nuevaTarea = trim($_POST["tarea"]);
                if (!empty($nuevaTarea)) {
                    if (isset($_COOKIE["tareasPendientes$usuario"])) {
                        $tareasPendientes = json_decode($_COOKIE["tareasPendientes$usuario"], true);
                    }
                    array_push($tareasPendientes, $nuevaTarea);
                    setcookie("tareasPendientes$usuario", json_encode($tareasPendientes), time() + 3600);
                    header("Location: gestor.php");
                    exit();
                }
            } else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["limpiar"])) {
                setcookie("tareasPendientes$usuario", "", time() - 3600);
                setcookie("tareasIniciadas$usuario", "", time() - 3600);
                setcookie("tareasTerminadas$usuario", "", time() - 3600);
                header("Location: gestor.php");
                exit();
            } 
            ?>
            <form action="gestor.php" method="post">
            <h3>Listado de Tareas Pendientes</h3>
            <table name="tareas-pendientes">
                <tr>
                    <th><input type="checkbox" disabled></th>
                    <th>Descripción</th>
                    <?php
                    if (isset($_COOKIE["tareasPendientes$usuario"])) {
                        $tareasPendientes = json_decode($_COOKIE["tareasPendientes$usuario"], true);
                        foreach ($tareasPendientes as $tarea) {
                            echo "<tr>";
                            echo "<td><input type='checkbox' name='input-pendiente' value='$tarea'></td>";
                            echo "<td>$tarea</td>";
                            echo "</tr>";
                        }
                    } 
                    ?>
                </tr>
            </table>
                <button type="submit" name="iniciar">Iniciar Tarea</button>
            </form>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["iniciar"])) {
                if (isset($_COOKIE["tareasIniciadas$usuario"])) {
                    $tareasIniciadas = json_decode($_COOKIE["tareasIniciadas$usuario"], true);
                }
                if (isset($_POST["input-pendiente"]) && !empty($_POST["input-pendiente"])) {
                    $tareasIniciadas = json_decode($_COOKIE["tareasIniciadas$usuario"] ?? "[]", true);
                } else {
                    header("Location: gestor.php");
                    exit();
                }
                array_push($tareasIniciadas, $_POST["input-pendiente"]);
                if (isset($_COOKIE["tareasPendientes$usuario"])) {
                    $tareasPendientes = json_decode($_COOKIE["tareasPendientes$usuario"], true);
                    $tareasPendientes = array_diff($tareasPendientes, [$_POST["input-pendiente"]]);
                    setcookie("tareasPendientes$usuario", json_encode($tareasPendientes), time() + 3600);
                }
                setcookie("tareasIniciadas$usuario", json_encode($tareasIniciadas), time() + 3600);
                header("Location: gestor.php");
                exit();
            }
            ?>
            <form action="gestor.php" method="post">
            <h3>Listado de Tareas Iniciadas</h3>
            <table name="tareas-iniciadas">
                <tr>
                    <th></th>
                    <th>Descripción</th>
                    <?php
                    if (isset($_COOKIE["tareasIniciadas$usuario"])) {
                        $tareasIniciadas = json_decode($_COOKIE["tareasIniciadas$usuario"], true);
                        foreach ($tareasIniciadas as $tarea) {
                            echo "<tr>";
                            echo "<td><input type='checkbox' name='input-iniciada' value='{$tarea}'></td>";
                            echo "<td>{$tarea}</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tr>
            </table>
                <button type="submit" name="terminar">Terminar Tarea</button>
            </form>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["terminar"])) {
                if (isset($_COOKIE["tareasTerminadas$usuario"])) {
                    $tareasTerminadas = json_decode($_COOKIE["tareasTerminadas$usuario"], true);
                }
                if (isset($_POST["input-iniciada"]) && !empty($_POST["input-iniciada"])) {
                    $tareasTerminadas = json_decode($_COOKIE["tareasTerminadas$usuario"] ?? "[]", true);
                } else {
                    header("Location: gestor.php");
                    exit();
                }
                array_push($tareasTerminadas, $_POST["input-iniciada"]);
                if (isset($_COOKIE["tareasIniciadas$usuario"])) {
                    $tareasIniciadas = json_decode($_COOKIE["tareasIniciadas$usuario"], true);
                    $tareasIniciadas = array_diff($tareasIniciadas, [$_POST["input-iniciada"]]);
                    setcookie("tareasIniciadas$usuario", json_encode($tareasIniciadas), time() + 3600);
                }
                setcookie("tareasTerminadas$usuario", json_encode($tareasTerminadas), time() + 3600);
                header("Location: gestor.php");
                exit();
            }
            ?>
            <h3>Listado de Tareas Terminadas</h3>
            <table name="tareas-terminadas">
                <tr>
                    <th>Nombre</th>
                    <?php
                    if (isset($_COOKIE["tareasTerminadas$usuario"])) {
                        $tareasTerminadas = json_decode($_COOKIE["tareasTerminadas$usuario"], true);
                        foreach ($tareasTerminadas as $tarea) {
                            echo "<tr>";
                            echo "<td>{$tarea}</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tr>
            </table>
            <form action="" method="post">
                <button type="submit" name="cerrar_sesion">Cerrar Sesión</button>
            </form>
        </article>
    </section>
    <footer>
        <p>&copy; 2025</p>
    </footer>
</body>
</html>