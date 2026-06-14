<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: Login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>QAPP Dashboard</title>

    <link rel="stylesheet" href="../public/assets/css/dashboard.css">
    <link rel="stylesheet" href="../public/assets/css/masterAccount.css">
</head>

<body>

<div class="wrapper">

    <!-- SIDEBAR -->
    <nav id="sidebar">

        <div class="sidebar-header">
            <h2>QAPP</h2>
            <small>
                <?php echo $_SESSION['nombre']; ?>
            </small>
        </div>

        <div class="menu-label">
            MENÚ PRINCIPAL
        </div>

        <ul class="components">

            <li>
                <a href="#" onclick="cargarContenido('home.php')">
                    Inicio
                </a>
            </li>

            <li>
                <a href="#" onclick="cargarContenido('masterAccount.php')">
                    Catálogo de Cuentas
                </a>
            </li>

            <li>
                <a href="#" onclick="cargarContenido('moveAccount.php')">
                    Movimientos
                </a>
            </li>

            <li>
                <a href="#" onclick="cargarContenido('balance.php')">
                    Balance de Comprobación
                </a>
            </li>

            <li>
                <a href="#" onclick="cargarContenido('conciliation.php')">
                    Conciliación Bancaria
                </a>
            </li>

        </ul>

    </nav>

    <!-- CONTENIDO -->
    <div id="content">

        <div class="top-bar">

            <button id="sidebarCollapse" class="btn-menu">
                ☰
            </button>

            <h3>QAPP - Sistema Financiero</h3>

            <div style="margin-left:auto">

                <a class="logout-link"
                   href="../views/Logout.php">
                    Cerrar Sesión
                </a>

            </div>

        </div>

        <div id="contenedor-principal" class="main-body">

            <div class="welcome-card">

                <h2>
                    Bienvenido,
                    <?php echo $_SESSION['nombre']; ?>
                </h2>

                <p>
                    Sistema de Gestión Financiera QAPP
                </p>

            </div>

            <div class="dashboard-cards">

                <div class="dashboard-card">
                    <h3>📋 Catálogo de Cuentas</h3>
                    <p>Administración de cuentas contables.</p>
                </div>

                <div class="dashboard-card">
                    <h3>💰 Movimientos</h3>
                    <p>Registro de transacciones.</p>
                </div>

                <div class="dashboard-card">
                    <h3>📊 Balance</h3>
                    <p>Consulta de balances.</p>
                </div>

                <div class="dashboard-card">
                    <h3>🏦 Conciliación</h3>
                    <p>Conciliación bancaria.</p>
                </div>

            </div>

        </div>

    </div>

</div>

<script src="../public/js/dashboard.js"></script>

</body>
</html>
