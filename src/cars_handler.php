<?php
$method = $_SERVER['REQUEST_METHOD'];

// Handle API requests
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
        $brand = $data['Brand'];
        $model = $data['Model'];
        $year = $data['Year'];
        $price = $data['Price'];
        $mileage = $data['Mileage'];
        $status = $data['Status'];

        $sql = "INSERT INTO Cars (Brand, Model, Year, Price, Mileage, Status)
                VALUES ('$brand', '$model', $year, $price, $mileage, '$status')";
        if ($conn->query($sql)) {
            echo json_encode(["message" => "Car added"]);
        } else {
            echo json_encode(["error" => $conn->error]);
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
                    $fields[] = "$key='$value'";
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