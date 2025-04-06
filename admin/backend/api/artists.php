<?php
header("Content-Type: application/json");
include('../config/dbconnect.php');

// Handle HTTP method for API routes
$method = $_SERVER['REQUEST_METHOD'];

// Handle API Routes
switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            // Fetch single artist by ID
            getArtistById($conn, $_GET['id']);
        } else {
            // Fetch all artists
            getAllArtists($conn);
        }
        break;
        
    case 'POST':
        // Create new artist
        createArtist($conn);
        break;
        
    case 'PUT':
        // Update existing artist
        if (isset($_GET['id'])) {
            updateArtist($conn, $_GET['id']);
        } else {
            echo json_encode(["message" => "Artist ID required for update"]);
        }
        break;
        
    case 'DELETE':
        // Delete artist
        if (isset($_GET['id'])) {
            deleteArtist($conn, $_GET['id']);
        } else {
            echo json_encode(["message" => "Artist ID required for deletion"]);
        }
        break;

    default:
        echo json_encode(["message" => "Method not allowed"]);
        break;
}

// Get all artists
function getAllArtists($conn) {
    try {
        $stmt = $conn->prepare("SELECT * FROM artists");
        $stmt->execute();
        $artists = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($artists);
    } catch (PDOException $e) {
        echo json_encode(["error" => "Failed to fetch artists", "message" => $e->getMessage()]);
    }
}

// Get artist by ID
function getArtistById($conn, $id) {
    try {
        $stmt = $conn->prepare("SELECT * FROM artists WHERE artist_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $artist = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($artist) {
            echo json_encode($artist);
        } else {
            echo json_encode(["message" => "Artist not found"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["error" => "Failed to fetch artist", "message" => $e->getMessage()]);
    }
}

// Create a new artist
function createArtist($conn) {
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (empty($data['first_name']) || empty($data['last_name'])) {
        echo json_encode(["message" => "First name and last name are required"]);
        return;
    }
    
    try {
        $stmt = $conn->prepare("INSERT INTO artists (first_name, last_name, birth_date, death_date, biography) 
        VALUES (:first_name, :last_name, :birth_date, :death_date, :biography)");

        $stmt->bindParam(':first_name', $data['first_name']);
        $stmt->bindParam(':last_name', $data['last_name']);
        $stmt->bindParam(':birth_date', $data['birth_date']);
        $stmt->bindParam(':death_date', $data['death_date']);
        $stmt->bindParam(':biography', $data['biography']);

        $stmt->execute();
        echo json_encode(["message" => "Artist created successfully"]);
    } catch (PDOException $e) {
        echo json_encode(["error" => "Failed to create artist", "message" => $e->getMessage()]);
    }
}

// Update an existing artist
function updateArtist($conn, $id) {
    $data = json_decode(file_get_contents("php://input"), true);

    if (empty($data['first_name']) || empty($data['last_name'])) {
        echo json_encode(["message" => "First name and last name are required"]);
        return;
    }

    try {
        $stmt = $conn->prepare("UPDATE artists SET first_name = :first_name, last_name = :last_name, 
        birth_date = :birth_date, death_date = :death_date, biography = :biography WHERE artist_id = :id");

        $stmt->bindParam(':first_name', $data['first_name']);
        $stmt->bindParam(':last_name', $data['last_name']);
        $stmt->bindParam(':birth_date', $data['birth_date']);
        $stmt->bindParam(':death_date', $data['death_date']);
        $stmt->bindParam(':biography', $data['biography']);
        $stmt->bindParam(':id', $id);

        $stmt->execute();
        echo json_encode(["message" => "Artist updated successfully"]);
    } catch (PDOException $e) {
        echo json_encode(["error" => "Failed to update artist", "message" => $e->getMessage()]);
    }
}

// Delete an artist
function deleteArtist($conn, $id) {
    try {
        $stmt = $conn->prepare("DELETE FROM artists WHERE artist_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            echo json_encode(["message" => "Artist deleted successfully"]);
        } else {
            echo json_encode(["message" => "Artist not found"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["error" => "Failed to delete artist", "message" => $e->getMessage()]);
    }
}
?>
