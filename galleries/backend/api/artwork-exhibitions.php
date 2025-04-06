<?php
// Include the database connection
include('../config/dbconnect.php');

// Get the HTTP method (GET, POST, PUT, DELETE)
$method = $_SERVER['REQUEST_METHOD'];

// Handle each HTTP method (CRUD operations)
switch ($method) {
    case 'GET':
        // Fetch all artwork-exhibition relationships or a specific one by ID
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $stmt = $pdo->prepare("SELECT * FROM artwork_exhibition WHERE exhibition_id = :id OR artwork_id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($results);
        } else {
            // Fetch all artwork-exhibition relationships
            $stmt = $pdo->prepare("SELECT * FROM artwork_exhibition");
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($results);
        }
        break;
    
    case 'POST':
        // Create a new relationship between artwork and exhibition
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['exhibition_id'], $data['artwork_id'])) {
            $stmt = $pdo->prepare("INSERT INTO artwork_exhibition (exhibition_id, artwork_id) VALUES (:exhibition_id, :artwork_id)");
            $stmt->bindParam(':exhibition_id', $data['exhibition_id'], PDO::PARAM_INT);
            $stmt->bindParam(':artwork_id', $data['artwork_id'], PDO::PARAM_INT);
            $stmt->execute();
            echo json_encode(['message' => 'Artwork-Exhibition relationship created successfully']);
        } else {
            echo json_encode(['error' => 'exhibition_id and artwork_id are required']);
        }
        break;

    case 'PUT':
        // Update an existing relationship
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($_GET['exhibition_id'], $_GET['artwork_id'], $data['exhibition_id'], $data['artwork_id'])) {
            $stmt = $pdo->prepare("UPDATE artwork_exhibition SET exhibition_id = :exhibition_id, artwork_id = :artwork_id WHERE exhibition_id = :exhibition_id AND artwork_id = :artwork_id");
            $stmt->bindParam(':exhibition_id', $data['exhibition_id'], PDO::PARAM_INT);
            $stmt->bindParam(':artwork_id', $data['artwork_id'], PDO::PARAM_INT);
            $stmt->execute();
            echo json_encode(['message' => 'Artwork-Exhibition relationship updated successfully']);
        } else {
            echo json_encode(['error' => 'exhibition_id and artwork_id are required']);
        }
        break;

    case 'DELETE':
        // Delete a relationship between artwork and exhibition
        if (isset($_GET['exhibition_id'], $_GET['artwork_id'])) {
            $stmt = $pdo->prepare("DELETE FROM artwork_exhibition WHERE exhibition_id = :exhibition_id AND artwork_id = :artwork_id");
            $stmt->bindParam(':exhibition_id', $_GET['exhibition_id'], PDO::PARAM_INT);
            $stmt->bindParam(':artwork_id', $_GET['artwork_id'], PDO::PARAM_INT);
            $stmt->execute();
            echo json_encode(['message' => 'Artwork-Exhibition relationship deleted successfully']);
        } else {
            echo json_encode(['error' => 'exhibition_id and artwork_id are required']);
        }
        break;

    default:
        echo json_encode(['error' => 'Invalid HTTP method']);
        break;
}
?>