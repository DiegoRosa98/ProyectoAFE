<?php
    date_default_timezone_set('America/El_Salvador');
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $now = date('Y-m-d H:i:s');
    if($_SESSION){
        if($now>$_SESSION['EXPIRES'])
        {
            return redirect()->to('/logout/1')->send();
        }
        if($_SESSION['ROL']!=1)
        {
            return redirect()->to('/home')->send();
        }
        $usuario = $_SESSION['USER'];
        if($perfil->count() == 0)
        {
            return redirect()->to('/perfil')->send();
        }
    }else{
        return redirect()->to('/')->send();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Administration Panel</title>

        <!-- sweetalert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet" />
        <!-- bootstrap css cdn link -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
        <!-- bootstrap and popper js cdn links -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
        <!-- other cdns -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
        <!-- template style -->
        <style>
            :root{--header-height: 3rem;--nav-width: 68px;--first-color: #528D7D;--first-color-light: #AFA5D9;--white-color: #F7F6FB;--body-font: 'Nunito', sans-serif;--normal-font-size: 1rem;--z-fixed: 100}*,::before,::after{box-sizing: border-box}body{position: relative;margin: var(--header-height) 0 0 0;padding: 0 1rem;font-family: var(--body-font);font-size: var(--normal-font-size);transition: .5s}a{text-decoration: none}.header{width: 100%;height: var(--header-height);position: fixed;top: 0;left: 0;display: flex;align-items: center;justify-content: space-between;padding: 0 1rem;background-color: var(--white-color);z-index: var(--z-fixed);transition: .5s}.header_toggle{color: var(--first-color);font-size: 1.5rem;cursor: pointer}.header_img{width: 35px;height: 35px;display: flex;justify-content: center;border-radius: 50%;overflow: hidden}.header_img img{width: 40px}.l-navbar{position: fixed;top: 0;left: -30%;width: var(--nav-width);height: 100vh;background-color: var(--first-color);padding: .5rem 1rem 0 0;transition: .5s;z-index: var(--z-fixed)}.nav{height: 100%;display: flex;flex-direction: column;justify-content: space-between;overflow: hidden}.nav_logo, .nav_link{display: grid;grid-template-columns: max-content max-content;align-items: center;column-gap: 1rem;padding: .5rem 0 .5rem 1.5rem}.nav_logo{margin-bottom: 2rem}.nav_logo-icon{font-size: 1.25rem;color: var(--white-color)}.nav_logo-name{color: var(--white-color);font-weight: 700}.nav_link{position: relative;color: var(--first-color-light);margin-bottom: 1.5rem;transition: .3s}.nav_link:hover{color: var(--white-color)}.nav_icon{font-size: 1.25rem}.show{left: 0}.body-pd{padding-left: calc(var(--nav-width) + 1rem)}.active{color: var(--white-color)}.active::before{content: '';position: absolute;left: 0;width: 2px;height: 32px;background-color: var(--white-color)}.height-100{height:100vh}@media screen and (min-width: 768px){body{margin: calc(var(--header-height) + 1rem) 0 0 0;padding-left: calc(var(--nav-width) + 2rem)}.header{height: calc(var(--header-height) + 1rem);padding: 0 2rem 0 calc(var(--nav-width) + 2rem)}.header_img{width: 40px;height: 40px}.header_img img{width: 45px}.l-navbar{left: 0;padding: 1rem 1rem 0 0}.show{width: calc(var(--nav-width) + 156px)}.body-pd{padding-left: calc(var(--nav-width) + 188px)}.dropdown-menu{background-color: #528D7D;}}
            .card {
                width: 240px;
                height: 215px;
            }
            .menu-i {
                font-size: 36px;
            }
        </style>
        <!-- template script -->
        <script>
            document.addEventListener("DOMContentLoaded", function (event) {
                const showNavbar = (toggleId, navId, bodyId, headerId) => {
                    const toggle = document.getElementById(toggleId),
                        nav = document.getElementById(navId),
                        bodypd = document.getElementById(bodyId),
                        headerpd = document.getElementById(headerId);

                    // Validate that all variables exist
                    if (toggle && nav && bodypd && headerpd) {
                        toggle.addEventListener("click", () => {
                            // show navbar
                            nav.classList.toggle("show");
                            // change icon
                            toggle.classList.toggle("bx-x");
                            // add padding to body
                            bodypd.classList.toggle("body-pd");
                            // add padding to header
                            headerpd.classList.toggle("body-pd");
                        });
                    }
                };

                showNavbar("header-toggle", "nav-bar", "body-pd", "header");

                /*===== LINK ACTIVE =====*/
                const linkColor = document.querySelectorAll(".nav_link");

                function colorLink() {
                    if (linkColor) {
                        linkColor.forEach((l) => l.classList.remove("active"));
                        this.classList.add("active");
                    }
                }
                linkColor.forEach((l) =>
                    l.addEventListener("click", colorLink)
                );

                // Your code to run since DOM is loaded and ready
            });
        </script>
    </head>
    <body id="body-pd" style="background-color: #F7F6FB;">
        <header class="header" id="header">
            <div class="header_toggle">
                <i class="bx bx-menu" id="header-toggle"></i>
            </div>
            <div class="d-flex">
                <!-- <img src="https://assets.stickpng.com/images/585e4bf3cb11b227491c339a.png" alt="" /> -->
                <a href="#" class="mx-3">
                    <!-- <i class="bx bxs-bell-ring nav_icon"></i> -->
                    <i class="bx bxs-bell nav_icon"></i>
                </a>
                <a href="#" class="">
                    <i class="bx bx-user nav_icon"></i>
                    <?php if($perfil->count() > 0) { echo($perfil[0]->nombreCompleto); } else { echo($usuario); }?>
                </a>
            </div>
        </header>
        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a href="#" class="nav_logo">
                        <i class="bx bx-layer nav_logo-icon"></i>
                        <span class="nav_logo-name">Banco GSA-SIFE</span>
                    </a>
                    <div class="nav_list">
                        <a href="/" class="nav_link active">
                            <i class="bx bxs-bank nav_icon"></i>
                            <span class="nav_name">Menu</span>
                        </a>
                        <a href="/admin/roles" class="nav_link">
                            <i class="bx bxs-user-account nav_icon"></i>
                            <span class="nav_name">Roles</span>
                        </a>
                        <a href="/admin/usuarios" class="nav_link">
                            <i class="bx bxs-user-check nav_icon"></i>
                            <span class="nav_name">Usuarios</span>
                        </a>
                        <a href="/admin/tipo-cuenta" class="nav_link">
                            <i class="bx bx-abacus nav_icon"></i>
                            <span class="nav_name">Tipo Cuentas</span>
                        </a>
                        <a href="/admin/cuentas" class="nav_link">
                            <i class="bx bx-credit-card nav_icon"></i>
                            <span class="nav_name">Cuentas</span>
                        </a>
                    </div>
                </div>
                <a role="button" onclick="logoutConfirm()" class="nav_link">
                    <i class="bx bx-log-out nav_icon"></i>
                    <span class="nav_name">Log Out</span>
                </a>
            </nav>
        </div>
        <!--Container Main start-->
        <div class=" bg-light">
            <h4 class="text-center">Administración Central</h4>

            <div class="d-flex justify-content-center flex-wrap mx-2 my-3">
                <a href="/admin/roles">
                    <div class="card m-1">
                        <div class="card-body d-flex align-items-center">
                            <i class="bx bxs-user-account nav_icon mx-1 menu-i" style="vertical-align: middle;"></i>
                            <h5 class="text-center">Roles</h5>
                        </div>
                    </div>
                </a>

                <a href="/admin/usuarios">
                    <div class="card m-1">
                        <div class="card-body d-flex align-items-center">
                            <i class="bx bxs-user-check nav_icon mx-1 menu-i" style="vertical-align: middle;"></i>
                            <h5 class="text-center">Administración de Usuarios</h5>
                        </div>
                    </div>
                </a>

                <a href="/admin/tipo-cuenta">
                    <div class="card m-1">
                        <div class="card-body d-flex align-items-center">
                            <i class="bx bx-abacus nav_icon mx-1 menu-i" style="vertical-align: middle;"></i>
                            <h5 class="text-center">Tipos de Cuentas</h5>
                        </div>
                    </div>
                </a>

                <a href="/admin/cuentas">
                    <div class="card m-1">
                        <div class="card-body d-flex align-items-center">
                            <i class="bx bx-abacus nav_icon mx-1 menu-i" style="vertical-align: middle;"></i>
                            <h5 class="text-center">Gestión de Cuentas</h5>
                        </div>
                    </div>
                </a>

                <!-- <a href="/admin/tipo-servicios">
                    <div class="card m-1">
                        <div class="card-body d-flex align-items-center">
                            <i class="bx bx-album nav_icon mx-1 menu-i" style="vertical-align: middle;"></i>
                            <h5 class="text-center">Configuración de Tipo de Servicios</h5>
                        </div>
                    </div>
                </a> -->

                <!-- <a href="/admin/servicios">
                    <div class="card m-1">
                        <div class="card-body d-flex align-items-center">
                            <i class="bx bx-album nav_icon mx-1 menu-i" style="vertical-align: middle;"></i>
                            <h5 class="text-center">Administración de Servicios</h5>
                        </div>
                    </div>
                </a> -->

            </div>
        </div>
        <!--Container Main end-->
        <script>
            function logoutConfirm() {
                Swal.fire({
                    title: '¡Advertencia!',
                    text: '¿Está seguro de salir?',
                    icon: 'warning',
                    confirmButtonText: 'Sí',
                    showDenyButton: true,
                    denyButtonText: 'No',

                }).then((result) => {
                    if(result.isConfirmed) {
                        window.location.replace('/logout/0')
                    }
                })
            }
        </script>
    </body>
</html>
