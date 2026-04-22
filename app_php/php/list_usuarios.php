<?php
session_start();
header('Content-Type: application/json');
require_once 'Connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $sql = "SELECT u.id, u.nombre, u.user_name, r.id_rol, r.descripcion
                FROM usuario u
                INNER JOIN rol r ON u.id_rol = r.id_rol";
        $stmt = $pdo->query($sql);
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultado);

    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode([ "error" => "Error en la base de datos" ]);
        error_log("ERROR EN list_usuarios.php: " . $e->getMessage());
    }
}
?>