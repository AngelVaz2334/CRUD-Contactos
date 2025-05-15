<?php
/*************************************************************/
/* Archivo:  index.php
 * Objetivo: página inicial de manejo de catálogo,
 *           incluye manejo de sesiones y plantillas
 * Autor:
 *************************************************************/
include_once("html/cabecera.html");
include_once("menu.php");
include_once("html/aside.html");
?>
        <section class="acceso">
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <form id="frm" method="post" action="login.php">
            <label for="txtUsuario">Usuario</label>
            <input type="text" name="txtUsuario" id="txtUsuario" required/>

            <label for="txtContrasena">Contraseña</label>
            <input type="password" name="txtContrasena" id="txtContrasena" required/>

            <input class="btn-enviar" type="submit" value="Ingresar"/>
        </form>
    </div>
</section>
<?php
include_once("html/pie.html");
?>
