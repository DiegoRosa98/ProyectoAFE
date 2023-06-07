<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registrate</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- bootstrap css cdn link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- bootstrap and popper js cdn links -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
</head>
<body class="body d-flex justify-content-center align-items-center">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="card-title fw-semibold mb-3">Registrate</h2>
                    <a href="/" class="btn btn-outline-primary fw-semibold">
                        <i class="bx bx-arrow-back nav_icon"></i> Regresar
                    </a>
                </div>
                <form class="needs-validation" action="/usuarios/crear" method="POST" novalidate>
                    @csrf
                    <div class="form-group my-3">
                        <label for="username" class="form-label fw-bolder">Correo:</label>
                        <input class="form-control" type="email" name="correo" id="correo" placeholder="Escriba su correo" required>
                        <div class="invalid-feedback">
                            Please provide a username.
                        </div>
                    </div>
                    <div class="form-group my-3">
                        <label for="username" class="form-label fw-bolder">Username:</label>
                        <input class="form-control" type="text" name="username" id="username" placeholder="Escriba su nombre de usuario" required>
                        <div class="invalid-feedback">
                            Please provide a username.
                        </div>
                    </div>
                    <div class="form-group my-3">
                        <label for="userPassword" class="form-label fw-bolder">Password:</label>
                        <input class="form-control" type="password" name="clave" id="clave" placeholder="Escriba su contraseña" required>
                        <div class="invalid-feedback">
                            Please provide your password.
                        </div>
                    </div>

                    <input type="hidden" name="idRol" id="idRol" value="2">
                    <input type="hidden" name="estado" id="estado" value="1">

                    <div class="col-12 d-flex justify-content-center">
                        <button type="submit" class="btn btn-outline-secondary fw-semibold">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
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
    <style>
        .body {
            font-family: 'Nunito', sans-serif;
            height: 100vh;
            width: 100%;
            background-color: rgb(82, 141, 125);
        }

        .btn {
            border-color: #528D7D;
            color: #528D7D;
        }
        .btn:hover {
            background-color: #528D7D;
            color: white;
            border-color: #528D7D;
        }

        .card-body {
            background-color: rgb(238, 249, 245);
        }

    </style>
</body>
</html>
