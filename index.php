<?php
if(isset($_GET["miRegistro"]))
{
    require "view/confirmarRegistro.php";
}
else if(isset($_GET["credencial"]))
{
    require "view/uploadCard.php";
}
else if(isset($_GET["registro"]))
{
    require "view/register.php";
}
else if(isset($_GET["bases"]))
{
    require "view/ruleBases.php";
}
else if(isset($_GET["carta"]))
{
    require "view/cartaRespAlumnos.php";
}
else if(isset($_GET["miBoleto"]))
{
  require "view/qr.php";
}
else if(isset($_GET["retos"]))
{
  require "view/retos.php";
}
else if(isset($_GET["agenda"]))
{
  require "view/agenda.php";
}
else if (empty($_GET) || isset($_GET["inicio"]))
{
    require "view/home.php";
}
else
{
    require "404.html";
}

?>
