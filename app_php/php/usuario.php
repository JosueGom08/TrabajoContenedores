<?php
session_start();
require_once 'Connection.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['metodo'])) {
        echo json_encode(["mensaje" => "Método no enviado", "estatus" => false]);
        exit;
    }

    if ($data['metodo'] === "ELIMINAR") {

        if (!isset($data['id_user'])) {
            echo json_encode([
                "mensaje" => "ID INCORRECTO",
                "estatus" => false
            ]);
            exit;
        }

        if ($_SESSION['user_id'] == $data['id_user']) {
            echo json_encode([
                "mensaje" => "No puedes eliminar tu propio usuario",
                "estatus" => false
            ]);
            exit;
        }

        try {

            $sql = "DELETE FROM usuario WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':id' => $data['id_user']]);

            echo json_encode([
                "mensaje" => "Usuario eliminado",
                "estatus" => true
            ]);
            exit;

        } catch (PDOException $e) {

            http_response_code(500);

            echo json_encode([
                "mensaje" => "Error en la base de datos",
                "estatus" => false
            ]);

            error_log("ERROR: " . $e->getMessage());
        }

    } else {
        echo json_encode([
            "mensaje" => "METODO NO ENCONTRADO",
            "estatus" => false
        ]);
    }
}
?>
