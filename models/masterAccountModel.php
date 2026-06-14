<?php

require_once "../config/db.php";

class accountModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function obtenerPorCuenta($cuenta): mixed
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM CONT01
            WHERE CUENTA = :cta
        ");

        $stmt->execute([
            ':cta' => $cuenta
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarCuenta($termino): mixed
    {
        $stmt = $this->db->prepare("
            SELECT
                CUENTA,
                DESCRIPCION
            FROM CONT01
            WHERE ESTATUS = 1
            AND (
                CUENTA LIKE :cuenta
                OR DESCRIPCION LIKE :descripcion
            )
            ORDER BY CUENTA
        ");

        $stmt->execute([
            ':cuenta' => "%{$termino}%",
            ':descripcion' => "%{$termino}%"
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function guardar($d): mixed
    {
        try {
            $this->db->beginTransaction();

            $params = [
                ':cta'  => $d['Cuenta'],
                ':desc' => $d['Descripcion'],
                ':orig' => $d['Origen'],
                ':niv'  => $d['Nivel'],
                ':aux'  => $d['Auxiliar'],
                ':ctrl' => $d['Control'],
                ':conc' => $d['Conciliacion'],
                ':est'  => $d['Estado'],
                ':imp'  => $d['Impuesto']
            ];

            $exists = $this->db->prepare("
                SELECT COUNT(*)
                FROM CONT01
                WHERE CUENTA = :cta
            ");
            $exists->execute([':cta' => $d['Cuenta']]);

            if ((int) $exists->fetchColumn() > 0) {
                $stmt = $this->db->prepare("
                    UPDATE CONT01
                    SET
                        DESCRIPCION = :desc,
                        ORIGEN = :orig,
                        NIVEL = :niv,
                        AUXILIAR = :aux,
                        CONTROL = :ctrl,
                        CONCILIACION = :conc,
                        ESTADO = :est,
                        IMPUESTO = :imp,
                        ESTATUS = 1
                    WHERE CUENTA = :cta
                ");
            } else {
                $stmt = $this->db->prepare("
                    INSERT INTO CONT01
                    (
                        CUENTA,
                        DESCRIPCION,
                        ORIGEN,
                        NIVEL,
                        AUXILIAR,
                        CONTROL,
                        CONCILIACION,
                        ESTADO,
                        IMPUESTO,
                        ESTATUS,
                        BALANCEANTERIOR,
                        DEBITO,
                        CREDITO,
                        BALANCEACTUAL
                    )
                    VALUES
                    (
                        :cta,
                        :desc,
                        :orig,
                        :niv,
                        :aux,
                        :ctrl,
                        :conc,
                        :est,
                        :imp,
                        1,
                        0,
                        0,
                        0,
                        0
                    )
                ");
            }

            $ok = $stmt->execute($params);

            if (!$ok) {
                $this->db->rollBack();
                return false;
            }

            $this->db->commit();
            return true;

        } catch (Throwable $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }

            return false;
        }
    }

    public function inactivar($cuenta): mixed
    {
        $stmt = $this->db->prepare("
            UPDATE CONT01
            SET ESTATUS = 0
            WHERE CUENTA = :cta
        ");

        return $stmt->execute([
            ':cta' => $cuenta
        ]);
    }
}
