<?php
// Include the database connection
include('db.php');

// Get the HTTP method (GET, POST, PUT, DELETE)
$method = $_SERVER['REQUEST_METHOD'];

// Handle each HTTP method (CRUD operations)
switch ($method) {
    case 'GET':
        // Fetch all exhibitions or a specific exhibition by ID
        if (isset($_GET['id'])) {
            // Fetch a specific exhibition by ID
            $stmt = $pdo->prepare("SELECT * FROM exhibitions WHERE id = :id");
            $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
            $stmt->execute();
            $exhibition = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode($exhibition);
        } else {
            // Fetch all exhibitions
            $stmt = $pdo->prepare("SELECT * FROM exhibitions");
            $stmt->execute();
            $exhibitions = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($exhibitions);
        }
        break;
    
    case 'POST':
        // Create a new exhibition
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['title'], $data['artist_id'], $data['description'], $data['price'], $data['image_path'])) {
            $stmt = $pdo->prepare("INSERT INTO exhibitions (title, artist_id, description, price, image_path) 
            VALUES (:title, :artist_id, :description, :price, :image_path)");
            
            $stmt->bindParam(':title', $data['title'], PDO::PARAM_STR);
            $stmt->bindParam(':artist_id', $data['artist_id'], PDO::PARAM_INT);
            $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
            $stmt->bindParam(':price', $data['price'], PDO::PARAM_STR);
            $stmt->bindParam(':image_path', $data['image_path'], PDO::PARAM_STR);

            $stmt->execute();
            echo json_encode(['message' => 'Exhibition created successfully']);
        } else {
            echo json_encode(['error' => 'Missing required fields']);
        }
        break;

    case 'PUT':
        // Update an exhibition
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (isset($_GET['id'], $data['title'], $data['artist_id'], $data['description'], $data['price'], $data['image_path'])) {
            $stmt = $pdo->prepare("UPDATE exhibitions 
                                   SET title = :title, artist_id = :artist_id, description = :description, price = :price, image_path = :image_path
                                   WHERE id = :id");

            $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
            $stmt->bindParam(':title', $data['title'], PDO::PARAM_STR);
            $stmt->bindParam(':artist_id', $data['artist_id'], PDO::PARAM_INT);
            $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
            $stmt->bindParam(':price', $data['price'], PDO::PARAM_STR);
            $stmt->bindParam(':image_path', $data['image_path'], PDO::PARAM_STR);

            $stmt->execute();
            echo json_encode(['message' => 'Exhibition updated successfully']);
        } else {
            echo json_encode(['error' => 'Missing required fields']);
        }
        break;

    case 'DELETE':
        // Delete an exhibition
        if (isset($_GET['id'])) {
            $stmt = $pdo->prepare("DELETE FROM exhibitions WHERE id = :id");
            $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
            $stmt->execute();
            echo json_encode(['message' => 'Exhibition deleted successfully']);
        } else {
            echo json_encode(['error' => 'Exhibition ID is required']);
        }
        break;

    default:
        echo json_encode(['error' => 'Invalid HTTP method']);
        break;
}
?>