<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include "Database.php";

// Get HTTP method
$method = $_SERVER['REQUEST_METHOD'];

// Function to sanitize input
function sanitize($conn, $data) {
    return htmlspecialchars($conn->real_escape_string($data));
}

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $result = $conn->query("SELECT * FROM Cars WHERE CarID=$id");
            echo json_encode($result->fetch_assoc());
        } else {
            $result = $conn->query("SELECT * FROM Cars");
            $cars = [];
            while ($row = $result->fetch_assoc()) {
                $cars[] = $row;
            }
            echo json_encode($cars);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $brand = sanitize($conn, $data['Brand']);
        $model = sanitize($conn, $data['Model']);
        $year = intval($data['Year']);
        $price = floatval($data['Price']);
        $mileage = floatval($data['Mileage']);
        $status = sanitize($conn, $data['Status']);

        $stmt = $conn->prepare("INSERT INTO Cars (Brand, Model, Year, Price, Mileage, Status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiddi", $brand, $model, $year, $price, $mileage, $status);
        if ($stmt->execute()) {
            echo json_encode(["message" => "Car added"]);
        } else {
            echo json_encode(["error" => $stmt->error]);
        }
        break;

    case 'PUT':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $data = json_decode(file_get_contents("php://input"), true);

            $fields = [];
            foreach ($data as $key => $value) {
                if (is_numeric($value)) {
                    $fields[] = "$key=$value";
                } else {
                    $fields[] = "$key='".sanitize($conn, $value)."'";
                }
            }
            $sql = "UPDATE Cars SET " . implode(",", $fields) . " WHERE CarID=$id";
            if ($conn->query($sql)) {
                echo json_encode(["message" => "Car updated"]);
            } else {
                echo json_encode(["error" => $conn->error]);
            }
        }
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $sql = "DELETE FROM Cars WHERE CarID=$id";
            if ($conn->query($sql)) {
                echo json_encode(["message" => "Car deleted"]);
            } else {
                echo json_encode(["error" => $conn->error]);
            }
        }
        break;

    default:
        echo json_encode(["error" => "Invalid Request"]);
        break;
}
?>