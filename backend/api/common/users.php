<?php
header('Content-Type: application/json');
require '../dbconnect.php'; // Fixed typo: 'required' → 'require'

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Get a specific user or all users
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $stmt = $db_handle->prepare("SELECT id, username, email, role, created_at FROM users WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            echo json_encode($result->fetch_assoc());
        } else {
            $result = $db_handle->query("SELECT id, username, email, role, created_at FROM users");
            $users = [];
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
            echo json_encode($users);
        }
        break;

    case 'POST':
        // Create new user 
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['username'], $data['password'], $data['email'])) {
            http_response_code(400);
            echo json_encode(["error" => "Missing required fields"]);
            exit();
        }

        $username = $db_handle->real_escape_string($data['username']);
        $email = $db_handle->real_escape_string($data['email']);
        $password = password_hash($data['password'], PASSWORD_BCRYPT);
        $role = isset($data['role']) ? $db_handle->real_escape_string($data['role']) : 'visitor';

        $stmt = $db_handle->prepare("INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $password, $email, $role);

        if ($stmt->execute()) {
            echo json_encode(["message" => "User created", "id" => $stmt->insert_id]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => $stmt->error]);
        }
        break;

    case 'PUT':
        // Update user
        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo json_encode(["error" => "Missing user ID"]);
            exit();
        }

        $id = intval($_GET['id']);
        $data = json_decode(file_get_contents('php://input'), true);

        $fields = [];
        $params = [];
        $types = "";

        if (isset($data['username'])) {
            $fields[] = "username = ?";
            $params[] = $data['username'];
            $types .= "s";
        }
        if (isset($data['email'])) {
            $fields[] = "email = ?";
            $params[] = $data['email'];
            $types .= "s";
        }
        if (isset($data['role'])) {
            $fields[] = "role = ?";
            $params[] = $data['role'];
            $types .= "s";
        }
        if (isset($data['password'])) {
            $fields[] = "password = ?";
            $params[] = password_hash($data['password'], PASSWORD_BCRYPT);
            $types .= "s";
        }

        if (empty($fields)) {
            http_response_code(400);
            echo json_encode(["error" => "No data to update"]);
            exit();
        }

        $types .= "i"; // For ID
        $params[] = $id;

        $sql = "UPDATE users SET " . implode(", ", $fields) . " WHERE id = ?";
        $stmt = $db_handle->prepare($sql);
        $stmt->bind_param($types, ...$params);

        if ($stmt->execute()) {
            echo json_encode(["message" => "User updated"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => $stmt->error]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Method not allowed"]);
        break;
}