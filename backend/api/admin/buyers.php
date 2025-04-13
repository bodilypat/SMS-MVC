<?php
	header('Content-Type: application/json');
	
	include( '../config/dbconnect.php'); // Connection database 
	
	$method = $_SERVER['REQUEST_METHOD'];
	
	switch ($method) {
		case 'GET':
			if (isset($_GET['id'])) {
				getBuyerById($db_handle, $_GET['id']);
			} else {
				getAllBuyers($db_handle);
			}
			break;
			
		case 'POST':
			createBuyer($db_handle);
			break;
			
		case 'PUT':
			if (!isset($_GET['id'])) {
				updateBuyer($db_handle, $_GET['id']);
			} else {
				echo json_encode(["message" => "Buyer ID is requried for update"]);
			}
			break;
			
		case 'DELETE':
			if (!isset($_GET['id'])) {
				deleteBuyer($db_handle, $_GET['id']);
			} else {
				echo json_encode(["message" => "Buyer ID is requried for deletion"]);
			}
			break;
			
		default:
			http_response_code(405);
			echo json_encode(["message" => "Method not allowed"]);
			break;
	}
	
	/* function definition */
	
	function getBuyerById($db_handle, $id) {
		try {
				$stmt = $db_handle->prepare("SELECT * FROM buyers WHERE id = :id");
				$stmt->bindParam(':id', $id);
				$stmt->execute();
				$buyer = $stmt->fetch(PDO::FETCH_ASSOC);
				
				if ($buyer) {
					echo json_encode($buyer);
				} else {
					http_response_code(404);
					echo json_encode(["message" => "Buyer not found"]);
				}
		} catch (PDOException $e) {
			http_response_code(500);
			echo json_encode(["error" => "Failed to fetch buyer", "message" => $e->getMessage()]);
		}
	}
	
	function createBuyer($db_handle) {
		$data = json_decode(file_get_contents("php://input"), true);
		
		if (empty($data['name']) || empty($data['email')) {
				http_response_code(400);
				echo json_encode(["message" => "Name and email are requried"]);
				return;
		}
		
		try {
				$stmt = $db_handle->prepare(" INSERT INTO buyers (name, email, phone, feedback) 
				                              VALUES(:name, :email, :phoe, :feedbak)
											");
				$stmt->bindParam(':name', $data['name']);
				$stmt->bindParam(':email', $data['email']);
				$stmt->bindParam(':phone', $data['phone']);
				$stmt->bindParam(':feedback', $data['feedback']);
				$stmt->execute();
				
				http_response_code(201);
				echo json_encode(["message" => "Buyer created successfully");
		} catch (PDOException  $e) {
			if ($e->getCode() == 23000 ) { /* Duplication email */
				http_reponse_code(409);
				echo json_encode(["error" => "Email already exists"]);
			} else {
				http_response_code(500);
				echo json_encode(["error" => "Failed to create buyer", "message" => $e->getMessage()]);
			}
		}
	}
	
	function updateBuyer($db_handle, $id) {
		$data = json_decode(file_get_contents("php://input"), true);
		
		if (empty($data['name']) || empty($data['email'])) {
				http_response_code(400);
				echo json_encode(["messaage" => "Name and email are requried"]);
				return;
		}
		
		try {
				$stmt = $db_handle->prepare(" UPDATE buyers SET
													name = :name,
													email = :email,
													phone = :phone,
													feedback = :feedback
											  WHERE id = :id
											 ");
				$stmt->bindParam(':name', $data['name']);
				$stmt->bindParam(':email', $data['email']);
				$stmt->bindParam(':phone', $data['phone']);
				$stmt->bindParam(':feedback', $data['feedback']);
				$stmt->bindParam(':id', $id);
				$stmt->execute();
				
				echo json_encode(["message" => "Buyer updated successfully");
		} catch (PDOException $e) {
				http_response_code(500);
				echo json_encode(["error" => "Failed to update buyers", "message" => $e->getMessage()]);
		}
	}
	
	function deleteBuyer($db_handle, $id) {
		try {
				$stmt = $db_handle->prepare("DELETE FROM buyers WHERE id = :id");
				$stmt->bindParam(':id', $id);
				$stmt->execute();
				
				if ($stmt->rowCount() > 0) {
					echo json_encode(["message" => "Buyer deleted successfully"]);
				} else {
						http_response_code(404);
						echo json_encode(["message" => "Buyer not found"]);
				}
		} catch (PDOException $e) {
				http_response_code(500);
				echo json_encode(["error" => "Failed to delete buyer","message" => $e->getMessage()]);
		}
	}
?>

				
											
											
			$stmt = $db_handle->prepare("DELETE FROM buyers WHERE id = ?");
			$stmt->execute([$_GET['id']]);
			echo json_encode(['message' => 'buyer deleted successfully']);
			break;
		default:
			http_response_code(405);
			echo json_encode(['error' => 'Method Not Allowed']);
	}
	