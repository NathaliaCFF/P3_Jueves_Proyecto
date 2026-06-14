<?php

class Database {

    public static function connect(): PDO {

        try {

            $conn = new PDO(
                "sqlsrv:Server=MYCOMPUTER;Database=BDPOSS;TrustServerCertificate=true"
            );

            $conn->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            return $conn;

        } catch(PDOException $e) {

            die(
                "Error de conexión: " . $e->getMessage()
            );

        }

    }

}