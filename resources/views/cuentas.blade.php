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
        if($_SESSION['ROL']!=2)
        {
            return redirect()->to('/home')->send();
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
        <title>Cuentas</title>

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
            :root{--header-height: 3rem;--nav-width: 68px;--first-color: #528D7D;--first-color-light: #AFA5D9;--white-color: #F7F6FB;--body-font: 'Nunito', sans-serif;--normal-font-size: 1rem;--z-fixed: 100}*,::before,::after{box-sizing: border-box}body{position: relative;margin: var(--header-height) 0 0 0;padding: 0 1rem;font-family: var(--body-font);font-size: var(--normal-font-size);transition: .5s}a{text-decoration: none}.header{width: 100%;height: var(--header-height);position: fixed;top: 0;left: 0;display: flex;align-items: center;justify-content: space-between;padding: 0 1rem;background-color: var(--white-color);z-index: var(--z-fixed);transition: .5s}.header_toggle{color: var(--first-color);font-size: 1.5rem;cursor: pointer}.header_img{width: 35px;height: 35px;display: flex;justify-content: center;border-radius: 50%;overflow: hidden}.header_img img{width: 40px}.l-navbar{position: fixed;top: 0;left: -30%;width: var(--nav-width);height: 100vh;background-color: var(--first-color);padding: .5rem 1rem 0 0;transition: .5s;z-index: var(--z-fixed)}.nav{height: 100%;display: flex;flex-direction: column;justify-content: space-between;overflow: hidden}.nav_logo, .nav_link{display: grid;grid-template-columns: max-content max-content;align-items: center;column-gap: 1rem;padding: .5rem 0 .5rem 1.5rem}.nav_logo{margin-bottom: 2rem}.nav_logo-icon{font-size: 1.25rem;color: var(--white-color)}.nav_logo-name{color: var(--white-color);font-weight: 700}.nav_link{position: relative;color: var(--first-color-light);margin-bottom: 1.5rem;transition: .3s}.nav_link:hover{color: var(--white-color)}.nav_icon{font-size: 1.25rem}.show{left: 0}.body-pd{padding-left: calc(var(--nav-width) + 1rem)}.active{color: var(--white-color)}.active::before{content: '';position: absolute;left: 0;width: 2px;height: 32px;background-color: var(--white-color)}.height-100{height:100vh}@media screen and (min-width: 768px){body{margin: calc(var(--header-height) + 1rem) 0 0 0;padding-left: calc(var(--nav-width) + 2rem)}.header{height: calc(var(--header-height) + 1rem);padding: 0 2rem 0 calc(var(--nav-width) + 2rem)}.header_img{width: 40px;height: 40px}.header_img img{width: 45px}.l-navbar{left: 0;padding: 1rem 1rem 0 0}.show{width: calc(var(--nav-width) + 156px)}.body-pd{padding-left: calc(var(--nav-width) + 188px)}.page-link{color:#528D7D;}}
            .btn-add{
                background-color: #528D7D;
                border-color: #528D7D;
                color: white;
            }
            .btn-add:hover{
                background-color: white;
                border-color: #528D7D;
                color: #528D7D;
                font-weight: 700;
            }
            .btn-back{
                background-color: #4E86B9;
                border-color: #4E86B9;
                color: white;
            }
            .btn-back:hover{
                background-color: white;
                border-color: #4E86B9;
                color: #4E86B9;
                font-weight: 700;
            }
            .btn-edit{
                background-color: white;
                border-color: #4E86B9;
                color: #4E86B9;
            }
            .btn-edit:hover{
                background-color: #4E86B9;
                border-color: #4E86B9;
                color: white;
            }
            .btn-del{
                background-color: white;
                border-color: #CA3838;
                color: #CA3838;
            }
            .btn-del:hover{
                background-color: #CA3838;
                border-color: #CA3838;
                color: white;
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
        <!-- template -->
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
                </a>
            </div>
        </header>
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
            function deleteConfirm($id) {
                Swal.fire({
                    title: '¡Advertencia!',
                    text: '¿Está seguro de eliminar el registro?',
                    icon: 'warning',
                    confirmButtonText: 'Sí',
                    showDenyButton: true,
                    denyButtonText: 'No',

                }).then((result) => {
                    if(result.isConfirmed) {
                        window.location.replace('/cuentas/eliminar/'+$id)
                    }
                })
            }
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
        </script>
        <div class="l-navbar" id="nav-bar">
        <nav class="nav">
                <div>
                    <a href="/" class="nav_logo">
                        <i class="bx bx-layer nav_logo-icon"></i>
                        <span class="nav_logo-name">Banco GSA-SIFE</span>
                    </a>
                    <div class="nav_list">
                        <a href="/cuentas" class="nav_link active">
                            <i class="bx bxs-bank nav_icon"></i>
                            <span class="nav_name">Cuenta</span>
                        </a>
                        <a href="/perfil" class="nav_link">
                            <i class="bx bx-user nav_icon"></i>
                            <span class="nav_name">Perfil</span>
                        </a>
                        <a href="/transferencias" class="nav_link">
                            <i class='bx bx-transfer nav_icon'></i>
                            <span class="nav_name">Transferencias</span>
                        </a>
                        <a href="/servicios" class="nav_link">
                            <i class='bx bx-dollar-circle nav_icon'></i>
                            <span class="nav_name">Pago de Servicios</span>
                        </a>
                        <!-- <a href="#" class="nav_link">
                            <i class="bx bx-message-square-detail nav_icon"></i>
                            <span class="nav_name">Messages</span>
                        </a> -->
                        <!-- <a href="#" class="nav_link">
                            <i class="bx bx-abacus nav_icon"></i>
                            <span class="nav_name">Servicios</span>
                        </a> -->
                        <!-- <a href="#" class="nav_link">
                            <i class="bx bx-folder nav_icon"></i>
                            <span class="nav_name">Files</span>
                        </a> -->

                    </div>
                </div>
                <a role="button" onclick="logoutConfirm()" class="nav_link">
                    <i class="bx bx-log-out nav_icon"></i>
                    <span class="nav_name">Log Out</span>
                </a>
            </nav>
        </div>
        <!-- end template -->
        <!--Container Main start-->
        <div class=" bg-light">
            <h4 class="text-center">Gestión de Cuentas</h4>
            <div class="d-flex justify-content-between my-3 mx-3">
                <a href="/home" class="btn btn-outline-secondary btn-back mx-2">
                    <i class="bx bx-arrow-back nav_icon" style="vertical-align: sub;"></i>Regresar
                </a>
                @if($cuentas->count() == 0)
                <a href="/cuentas/crear" class="btn btn-outline-secondary btn-add" >
                    <i class="bx bx-plus nav_icon" style="vertical-align: sub;"></i>Nueva Cuenta
                </a>
                @endif
            </div>

            <!-- data list -->
            <div class="mx-3">
                @if(session("message"))
                    <script>
                        Toast.fire({
                            icon: 'success',
                            title: '{{session("message")}}'
                        });
                    </script>
                @endif
                @if($cuentas->count() == 0)
                    <div class="card col-12 m-2">
                        <div class="card-body">
                            <h5 class="text-center fw-bolder">No hay registros</h5>
                        </div>
                    </div>
                @endif
                @foreach ($cuentas as $cuenta)
                    <div class="card col-12 m-2">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h5 class="fw-bolder">{{ $cuenta->username }}</h5>
                                    <h6>No Cuenta: {{ $cuenta->numeroCuenta }}</h6>
                                    <h6>Tipo Cuenta: {{ $cuenta->tipoCuenta }}</h6>
                                    <h6>Fecha creación: {{ $cuenta->created_at }}</h6>
                                    <h6>Última modificación: {{ $cuenta->updated_at }}</h6>
                                </div>
                                <div>
                                    <!-- <a class="btn btn-outline-primary btn-edit" href="/admin/cuentas/editar/{{$cuenta->id}}">
                                        <i class="bx bx-pencil nav_icon mx-1" style="vertical-align: middle;"></i>
                                    </a> -->
                                    <a class="btn btn-outline-danger btn-del" role="button" onclick="deleteConfirm('{{$cuenta->id}}')">
                                        <i class="bx bx-trash nav_icon mx-1" style="vertical-align: middle;"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <!-- data list -->
        </div>
        <!--Container Main end-->

    </body>
</html>
