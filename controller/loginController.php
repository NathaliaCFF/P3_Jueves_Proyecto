<?php

require_once '../config/db.php';

header('Content-Type: application/json');

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user = $_POST['usuario'] ?? '';
    $pass = $_POST['password'] ?? '';

    try {

        $db = Database::connect();

        $stmt = $db->prepare("EXEC sp_ValidarUsuario :u, :p");

        $stmt->bindParam(':u', $user);
        $stmt->bindParam(':p', $pass);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && $result['success'] == 1) {

            $_SESSION['usuario'] = $result['USERS'];
            $_SESSION['nombre'] = $result['NOMBRE'];
            $_SESSION['posicion'] = $result['POSICION'];

            echo json_encode([
                'success' => true
            ]);

        } else {

            echo json_encode([
                'success' => false,
                'message' => 'Usuario o contraseña incorrectos'
            ]);
        }

    } catch(PDOException $e) {

        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
}