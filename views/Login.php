<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Configuración básica -->
    <meta charset="UTF-8">

    <!-- Adaptación a dispositivos móviles -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Bienvenido - Login</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../public/assets/css/login.css">
</head>

<body>

    <div class="login-container">

        <div class="left-panel">
            <!-- Aquí puedes colocar una imagen o logo -->
        </div>

        <div class="right-panel">

            <div class="form-box">

                <!-- Avatar -->
                <div class="avatar"></div>

                <h1>BIENVENIDO</h1>

                <div id="error-alert" class="alert hidden">
                    ACCESO DENEGADO
                </div>

                <form id="loginForm">

                    <div class="input-group">
                        <label>Usuario</label>

                        <div class="input-wrapper">
                            <input
                                type="text"
                                name="usuario"
                                required
                            >
                        </div>
                    </div>

                    <div class="input-group">
                        <label>Password</label>

                        <div class="input-wrapper">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                required
                            >

                            <span id="togglePassword" class="eye-icon"></span>
                        </div>
                    </div>

                    <a href="#" class="forgot-link">
                        Olvidé mi contraseña
                    </a>

                    <button type="submit" class="btn-submit">
                        INICIAR SESIÓN
                    </button>

                </form>

            </div>

        </div>

    </div>

    <script src="../public/js/login.js"></script>

</body>
</html>