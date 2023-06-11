<?php
date_default_timezone_set('America/El_Salvador');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$now = date('Y-m-d H:i:s');
if($now>$_SESSION['EXPIRES'])
{
    return redirect()->to('/logout')->send();
}
?>
<html>
    <body>
        <h1>Inicio de sesión correcto</h1>
        <br>
        <center><a href="/logout">Cerrar Sesión</a></center>
    </body>
</html>
