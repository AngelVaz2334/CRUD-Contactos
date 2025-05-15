<?php
/*************************************************************/
/* Archivo:  inicio.php
 * Objetivo: página de sesión iniciada
 * Autor:    
 *************************************************************/
include_once("modelo/Usuario.php");
include_once("modelo/Contacto.php"); // Añadido para acceder a Contacto
session_start();

$sErr = "";
$sNom = "";
$sRol = "";
$arrContactos = null;

if (isset($_SESSION["usuario"])) {
    $sNom = $_SESSION["usuario"];
    $sRol = $_SESSION["rol"];
} else {
    $sErr = "Debe iniciar sesión primero";
}

if ($sErr == "") {
    include_once("html/cabecera.html");
    include_once("menu.php");
    include_once("html/aside.html");
} else {
    header("Location: error.php?sError=" . urlencode($sErr));
    exit();
}
?>

<section>
    <h1>Bienvenido, <?php echo htmlspecialchars($sNom); ?></h1>
    <h3>Contactos</h3>
    <br>

    <form name="formTablaGral" method="post" action="abcContacto.php">
        <div class="tabla-centro">
            <?php include_once("modelo/mostrarContactos.php"); ?>
            <br>
            <?php if ($sRol == "1") { ?>
                <input type="submit" value="Agregar nuevo contacto" onclick="txtClave.value='-1'; txtOpe.value='a'">
            <?php } ?>
        </div>
    </form>
</section>

<?php include_once("html/pie.html"); ?>
