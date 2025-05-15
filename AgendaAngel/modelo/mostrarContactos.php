<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Contactos</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
<?php
// Iniciar sesión si no está iniciada (por seguridad)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar que el usuario esté autenticado
if (!isset($_SESSION["usuario"])) {
    echo "<p style='text-align:center;'>Debe iniciar sesión primero</p>";
    exit();
}

// Crea el objeto Contacto
$oContacto = new Contacto();

try {
    // Obtener todos los contactos
    $arrContactos = $oContacto->buscarTodos();

    // Si existen contactos, se muestran en la tabla
    if ($arrContactos) {
?>
        <div class="responsive-table">
            <table border="1" class="tabla-contactos">
                <tr>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
                <?php foreach ($arrContactos as $contacto) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($contacto->getNombre()); ?></td>
                        <td><?php echo htmlspecialchars($contacto->getDireccion()); ?></td>
                        <td><?php echo htmlspecialchars($contacto->getTelefono()); ?></td>
                        <td><?php echo htmlspecialchars($contacto->getEmail()); ?></td>
                        <td>
                            <?php if ($_SESSION["rol"] == "1") { ?>
                                <form method="post" action="abcContacto.php" class="formEliminar">
                                    <input type="hidden" name="txtClave" value="<?php echo $contacto->getId(); ?>">
                                    <input type="hidden" name="txtOpe" class="txtOpe" value="">
                                    <input type="submit" value="Modificar" onclick="this.form.txtOpe.value='m';">
                                    <input type="button" value="Eliminar" class="btnEliminar">
                                </form>
                            <?php } else { ?>
                                <p>Solo Visualizar</p>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
<?php
    } else {
        echo "<p style='text-align:center;'>No hay contactos registrados</p>";
    }
} catch (Exception $e) {
    echo "<p style='text-align:center;'>Error al recuperar contactos</p>";
    error_log($e->getMessage());
}
?>
</body>
</html>
