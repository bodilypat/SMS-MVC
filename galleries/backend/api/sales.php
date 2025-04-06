<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set headers for JSON response
header('Content-Type: application/json');

// Determine HTTP method
$method = $_SERVER['REQUEST_METHOD'];

// Helper function to send a JSON response
function sendResponse($statusCode, $message, $data = null) {
    http_response_code($statusCode);
    echo json_encode([
        'message' => $message,
        'data' => $data
    ]);
    exit;
}

// Include the database connection
include('db_connection.php');  // Assumes db_connection.php contains the DB connection code above

// Route the requests based on the HTTP method
switch ($method) {
    case 'GET':
        // Fetch all sales or a specific sale
        if (isset($_GET['id'])) {
            // Get a specific sale by ID
            getSaleById($pdo, $_GET['id']);
        } else {
            // Get all sales
            getAllSales($pdo);
        }
        break;
    
    case 'POST':
        // Create a new sale
        createSale($pdo);
        break;

    case 'PUT':
        // Update an existing sale
        updateSale($pdo);
        break;

    case 'DELETE':
        // Delete a sale by ID
        deleteSale($pdo);
        break;

    default:
        sendResponse(405, 'Method Not Allowed');
}

// GET all sales function
function getAllSales($pdo) {
    $sql = "SELECT * FROM sales";
    $stmt = $pdo->query($sql);

    if ($stmt->rowCount() > 0) {
        $sales = $stmt->fetchAll(PDO::FETCH_ASSOC);
        sendResponse(200, 'Sales fetched successfully', $sales);
    } else {
        sendResponse(404, 'No sales found');
    }
}

// GET a specific sale by ID function
function getSaleById($pdo, $id) {
    $sql = "SELECT * FROM sales WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);

    if ($stmt->rowCount() > 0) {
        $sale = $stmt->fetch(PDO::FETCH_ASSOC);
        sendResponse(200, 'Sale fetched successfully', $sale);
    } else {
        sendResponse(404, 'Sale not found');
    }
}

// POST: Create a new sale
function createSale($pdo) {
    $data = json_decode(file_get_contents('php://input'), true);

    // Validate input
    if (!isset($data['artwork_id'], $data['user_id'], $data['amount'])) {
        sendResponse(400, 'Missing required fields: artwork_id, user_id, or amount');
    }

    $artwork_id = $data['artwork_id'];
    $user_id = $data['user_id'];
    $amount = $data['amount'];

    $sql = "INSERT INTO sales (artwork_id, user_id, amount) VALUES (:artwork_id, :user_id, :amount)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([':artwork_id' => $artwork_id, ':user_id' => $user_id, ':amount' => $amount]);
        sendResponse(201, 'Sale created successfully');
    } catch (PDOException $e) {
        sendResponse(500, 'Failed to create sale: ' . $e->getMessage());
    }
}

// PUT: Update an existing sale
function updateSale($pdo) {
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $_GET['id'];  // Sale ID from query string

    // Validate input
    if (!isset($data['artwork_id'], $data['user_id'], $data['amount'])) {
        sendResponse(400, 'Missing required fields: artwork_id, user_id, or amount');
    }

    $artwork_id = $data['artwork_id'];
    $user_id = $data['user_id'];
    $amount = $data['amount'];

    $sql = "UPDATE sales SET artwork_id = :artwork_id, user_id = :user_id, amount = :amount WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            ':artwork_id' => $artwork_id,
            ':user_id' => $user_id,
            ':amount' => $amount,
            ':id' => $id
        ]);
        sendResponse(200, 'Sale updated successfully');
    } catch (PDOException $e) {
        sendResponse(500, 'Failed to update sale: ' . $e->getMessage());
    }
}

// DELETE: Delete a sale
function deleteSale($pdo) {
    $id = $_GET['id'];  // Sale ID from query string

    $sql = "DELETE FROM sales WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([':id' => $id]);

        if ($stmt->rowCount() > 0) {
            sendResponse(200, 'Sale deleted successfully');
        } else {
            sendResponse(404, 'Sale not found');
        }
    } catch (PDOException $e) {
        sendResponse(500, 'Failed to delete sale: ' . $e->getMessage());
    }
}
?>