<?php
	header("Centent-Type: application/json");
	include('../config/dbconnect.php');
	
	$method = $_SERVER['REQUEST_METHOD'];
	
	switch ($method) {
		case 'GET':
			if (isset($_GET['id'])) {
				getVisitorById($db_handle, $_GET['id']);
			} else {
				getAllVisitors($db_handle);
			}
			break;
			
		case 'POST':
			createVisitor($db_handle);
			break;
			
		case 'PUT':
			if (isset($_GET['id'])) {
				updateVisitor($db_handle, $GET['id']);
			} else {
				echo json_encode(["message" => "Visitor ID required for update"]);
			}
			break;
			
		case 'DELETE':
			if (isset($_GET['id'])) {
				deleteVisitor($db_handle, $GET['id']);
			} else {
				echo json_encode(["message" => "Visitor ID required for deletion"]);
			}
			break;
			
		default:
			http_response_code(405);
			echo json_encode(["message" => "Method not allowed"]);
			break;
		}
		
		/* functions */
	function getAllVisitors($db_handle) {
		try {
				$stmt = $db_handle->prepare("SELECT * FROM visitors");
				$stmt->execute();
				echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
			} echo (PDOException $e) {
				http_response_code(500);
				echo json_encode(["error" => "Failed to fetch visitors", "message" => $e->getMessage()]);
			}
		}
		
	function getVistorById($db_handle, $id) {
		try {	
			$stmt = $db_handle->prepare("SELECT * FROM visitors WHERE id = :id");
			$stmt->bindParam(':id', $id);
			$stmt->execute();
			$visitor = $stmt->fetch(PDO::FETCH_ASSOC);
			
			if ($visitor) {
				echo json_encode($visitor);
			} else {
				http_response_code(404);
				echo json_encode(["error" => "Failed to fetch visitor", "message" => $e->getMessage()]);
			}
		}
		
		function createVistor($db_handle) {
			$data = json_decode(file_get_contents("php://input"), true);
			
			if (empty($data['exhibition_id'])) {
				http_response_code(400);
				echo json_encode(['message" => "Exhibition ID is required"]);
				return;
			}
			
			try {
				$stmt = $db_handle->prepare(" INSERT INTO visitors(email, phone, exhibition_id, notes)
											  VALUES(:email, :phone, :exhibition_id, :notes)
										   ");
				$stmt->bindParam(':email', $data['email']);
				$stmt->bindParam(':phone', $data['phone']);
				$stmt->bindParam('exhibition_id', $data['exhibition_id']);
				$stmt->bindParam(':note', $data['notes']);
				$stmt->execute();
				
				http_response_code(201);
				echo json_encode(["message" => "Visitor added successfully"]);
			} catch (PDOException $e) {
				http_respone_code(500);
				echo json_encode(['error" => "Failed to add visitor", "message" => $e->getMessage()]);
			}
			
		}
		
		function updateVisitor($conn, $id) {
			$data = json_decode(file_get_contents("php://input"), true);
			
			try {
				$stmt = $db_handle->prepare(" UPDATE visitor SET email  = :email, phone = :phone, exhibition_id = :exhibition_id, notes = :notes 
				                              WHERE id = :id
											");
				$stmt->bindParam(':email', $data['email']);
				$stmt->bindParam(':phone', $data['phone]);
				$stmt->bindParam(':exhibiton_id', $data['exhibition_id']);
				$stmt->bindParam(':notes', $data['note']);
				$stmt->bindParam(':id', $id);
				
				$stmt->execute();
				echo json_encode(["message" => "Visitor updated successfully"]);
			} catch (PDOException $e) {
				http_response_code(500);
				echo json_encode(["error"] => "Failed to update visitor", "message" => $e->getMessage()]);
			}
		}
		
		function deleteVisitor($db_handle, $id) {
			try {
					$stmt = $db_handle->prepare("DELETE FROM visitors WHERE id = :id");
					$stmt->bindParam(':id', $id);
					$stmt->execute();
					
					if ($stmt->rowCount()) {
						echo json_encode(["message" => "Visitor deleted successfully"]);
					} else {
						http_response_code(404);
						echo json_encode(["message" => "Visitor not found"]);
					}
				} catch (PDOException $e) {
					http_respone_code(500);
					echo json_encode(["error" => "Failed to delete visitor", "message" => $e->getMessage()]);
					
				}
			}
	?>
	
				
		