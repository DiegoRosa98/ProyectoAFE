<?php
    date_default_timezone_set('America/El_Salvador');
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $now = date('Y-m-d H:i:s');
    if($_SESSION){
        if($now>$_SESSION['EXPIRES'])
        {
            return redirect()->to('/logout')->send();
        }
        if($_SESSION['ROL']!=2)
        {
            return redirect()->to('/home')->send();
        }
    }else{
        return redirect()->to('/')->send();
    }

    if(!(is_null($perfil)))
    {
        $id = $perfil->id;
        $nombreCompleto = $perfil->nombreCompleto;
        $edad = $perfil->edad;
        $sexo = $perfil->sexo;
        $estadoCivil = $perfil->estadoCivil;
        $direccion = $perfil->direccion;
        $dui = $perfil->dui;
        $nit = $perfil->nit;
    }
    else
    {
        $id = "";
        $nombreCompleto = "";
        $edad = "";
        $sexo = "";
        $estadoCivil = "";
        $direccion = "";
        $dui = "";
        $nit = "";
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Gestión de Roles</title>

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
            .btn-save{
                background-color: #528D7D;
                border-color: #528D7D;
                color: white;
            }
            .btn-save:hover{
                background-color: white;
                border-color: #528D7D;
                color: #528D7D;
            }
            .btn-cancel{
                background-color: #CA3838;
                border-color: #CA3838;
                color: white;
            }
            .btn-cancel:hover{
                background-color: white;
                border-color: #CA3838;
                color: #CA3838;
            }
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
            
            <h4>Perfil</h4>
            
            <div class="d-flex justify-content-center">
                <div class="card col-6">
                    <div class="card-body">
                        <input type="hidden" name="selectSex" id="selectSex" value="{{$sexo}}">
                        <input type="hidden" name="selectEC" id="selectEC" value="{{$estadoCivil}}">
                        <form class="needs-validation" novalidate action="/perfil/guardar" method="POST">
                            @csrf
                            {{ method_field('POST') }}
                            <div class="form-group col-12">
                                <input type="hidden" class="form-control" name="id" id="id" required value="{{$id}}">
                                <label for="">Nombre Completo:</label>
                                <input type="text" class="form-control" name="nombreCompleto" id="nombreCompleto" required value="{{$nombreCompleto}}">
                                <div class="invalid-feedback">
                                    This field is required.
                                </div>
                                <br>
                                <label for="">Edad:</label>
                                <input type="number" class="form-control" name="edad" id="edad" required value="{{$edad}}">
                                <div class="invalid-feedback">
                                    This field is required.
                                </div>
                                <br>
                                <label for="">Sexo:</label>
                                <select class="form-control" name="sexo" id="sexo" required>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
                                <div class="invalid-feedback">
                                    This field is required.
                                </div>
                                <br>
                                <label for="">Estado Cívil:</label>
                                <select class="form-control" name="estadoCivil" id="estadoCivil" required>
                                    <option value="Soltero/a">Soltero/a</option>
                                    <option value="Casado/a">Casado/a</option>
                                    <option value="Divorciado/a">Divorciado/a</option>
                                    <option value="Viudo/a">Viudo/a</option>
                                </select>
                                <div class="invalid-feedback">
                                    This field is required.
                                </div>
                                <br>
                                <label for="">Dirección:</label>
                                <textarea class="form-control" name="direccion" id="direccion" cols="50" rows="5" required>{{$direccion}}</textarea>
                                <div class="invalid-feedback">
                                    This field is required.
                                </div>
                                <br>
                                <label for="">DUI:</label>
                                <input type="text" class="form-control" name="dui" id="dui" required value="{{$dui}}">
                                <div class="invalid-feedback">
                                    This field is required.
                                </div>
                                <br>
                                <label for="">NIT:</label>
                                <input type="text" class="form-control" name="nit" id="nit" required value="{{$nit}}">
                                <div class="invalid-feedback">
                                    This field is required.
                                </div>
                                <br>
                                <input type="hidden" name="idUsuario" id="idUsuario" value="{{$_SESSION['ID']}}">
                                <input type="hidden" name="estado" value="1">
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                            <button type="button" class="btn btn-outline-secondary btn-cancel mx-2" onclick="cancelConfirm()">
                                    <i class="bx bx-x nav_icon" style="vertical-align: sub;"></i>Cancelar
                                </button>
                                <button type="submit" class="btn btn-outline-secondary btn-save mx-2">
                                    <i class="bx bx-save nav_icon" style="vertical-align: sub;"></i>Guardar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-1">
                </div>
                <div class="card col-5" style="height: 425px;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex">
                                <i class="bx bx-user nav_icon mx-1"></i>
                                <h5>Información Personal</h5>
                            </div>
                        </div>
                        <div class="">
                                <br>
                                <label for="">Nombre Completo: {{$nombreCompleto}}</label>
                                <br>
                                <br>
                                <label for="">Edad: {{$edad}}</label>
                                <br>
                                <br>
                                <label for="">Sexo: {{$sexo}}</label>
                                <br>
                                <br>
                                <label for="">Estado Cívil: {{$estadoCivil}}</label>
                                <br>
                                <br>
                                <label for="">Dirección: {{$direccion}}</label>
                                <br>
                                <br>
                                <label for="">DUI: {{$dui}}</label>
                                <br>
                                <br>
                                <label for="">NIT: {{$nit}}</label>
                        </div>
                    </div>
                </div>
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
                        window.location.replace('/logout')
                    }
                })
            }
            function cancelConfirm() {
                Swal.fire({
                    title: '¡Advertencia!',
                    text: '¿Está seguro de regresar? No se guardarán los cambios.',
                    icon: 'warning',
                    confirmButtonText: 'Sí',
                    showDenyButton: true,
                    denyButtonText: 'No',

                }).then((result) => {
                    if(result.isConfirmed) {
                        window.location.replace('/')
                    }
                })
            }
            $('#sexo').val($('#selectSex').val());
            $('#estadoCivil').val($('#selectEC').val());
            (() => {
                'use strict'

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                const forms = document.querySelectorAll('.needs-validation')

                // Loop over them and prevent submission
                Array.from(forms).forEach(form => {
                    form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                    }, false)
                })
            })()
        </script>
    </body>
</html>
