<?php
	header('Content-Type: application/json');
	include('../config/dbconnect.php');
	
	$method = $_SERVER['REQUEST_METHOD'];
	
	switch ($method) {
		case 'GET':
			if (isset($_GET['exhibition_id']) && isset($_GET['artwork_id'])) {
				getOne($db_handle, $_GET['exhibition_id'], $_GET['artwork_id']);
			} else {
				getAll($db_handle);
			}
			break; 
		
		case 'POST': 
			create($db_handle);
			break;
			 
		case 'PUT':
			if (isset($_GET['exhibition_id']) && isset($_GET['artwork_id'])) {
				update($db_handle, $_GET['exhibition_id'], $_GET['artwork_id']);
			} else {
				echo json_encode(["message" => "Both exhibition_id and artwork_id are required for update"]);
			}
			break; 
		
		case 'DELETE':
			if (isset($_GET['exhibition_id']) && isset($_GET['artwork_id'])) {
				delete($db_handle, $_GET['exhibition_id'], $_GET['artwork_id']);
			} else {
				echo json_encode(["message" => "Both exhibition_id and artwork_id are required for deletion"]);
			}
			break;
		
		default:
			http_response_code(405);
			echo json_encode(["message" => "Method not allowed"]);
			break;
	}

	/* FUNCTION DEFINITIONS */
	
	function getAll($db_handle) {
		try {
			$stmt = $db_handle->query("SELECT * FROM exhibition_artworks");
			echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
		} catch (PDOException $e) {
			http_response_code(500);
			echo json_encode(["error" => $e->getMessage()]);
		}
	}

	function getOne($db_handle, $exhibition_id, $artwork_id) {
		try {
			$stmt = $db_handle->prepare("SELECT * FROM exhibition_artworks WHERE exhibition_id = :exhibition_id AND artwork_id = :artwork_id");
			$stmt->bindParam(':exhibition_id', $exhibition_id);
			$stmt->bindParam(':artwork_id', $artwork_id);
			$stmt->execute();
			$artwork = $stmt->fetch(PDO::FETCH_ASSOC);

			if ($artwork) {
				echo json_encode($artwork);
			} else {
				http_response_code(404);
				echo json_encode(["message" => "Artwork not found"]);
			}
		} catch (PDOException $e) {
			http_response_code(500);
			echo json_encode(["error" => $e->getMessage()]);
		}
	}

	function create($db_handle) {
		$data = json_decode(file_get_contents("php://input"), true);

		if (empty($data['exhibition_id']) || empty($data['artwork_id'])) {
			http_response_code(400);
			echo json_encode(["message" => "Both exhibition_id and artwork_id are required"]);
			return;
		}

		try {
			$stmt = $db_handle->prepare("INSERT INTO exhibition_artworks (exhibition_id, artwork_id, title, description) 
			                             VALUES (:exhibition_id, :artwork_id, :title, :description)");
			$stmt->bindParam(':exhibition_id', $data['exhibition_id']);
			$stmt->bindParam(':artwork_id', $data['artwork_id']);
			$stmt->bindParam(':title', $data['title']);
			$stmt->bindParam(':description', $data['description']);
			$stmt->execute();

			http_response_code(201);
			echo json_encode(["message" => "Artwork created successfully"]);
		} catch (PDOException $e) {
			http_response_code(500);
			echo json_encode(["error" => "Failed to create artwork", "message" => $e->getMessage()]);
		}
	}

	function update($db_handle, $exhibition_id, $artwork_id) {
		$data = json_decode(file_get_contents("php://input"), true);

		try {
			$stmt = $db_handle->prepare("UPDATE exhibition_artworks SET title = :title, description = :description
			                             WHERE exhibition_id = :exhibition_id AND artwork_id = :artwork_id");
			$stmt->bindParam(':title', $data['title']);
			$stmt->bindParam(':description', $data['description']);
			$stmt->bindParam(':exhibition_id', $exhibition_id);
			$stmt->bindParam(':artwork_id', $artwork_id);
			$stmt->execute();

			echo json_encode(["message" => "Artwork updated successfully"]);
		} catch (PDOException $e) {
			http_response_code(500);
			echo json_encode(["error" => "Failed to update artwork", "message" => $e->getMessage()]);
		}
	}

	function delete($db_handle, $exhibition_id, $artwork_id) {
		try {
			$stmt = $db_handle->prepare("DELETE FROM exhibition_artworks WHERE exhibition_id = :exhibition_id AND artwork_id = :artwork_id");
			$stmt->bindParam(':exhibition_id', $exhibition_id);
			$stmt->bindParam(':artwork_id', $artwork_id);
			$stmt->execute();

			if ($stmt->rowCount()) {
				echo json_encode(["message" => "Artwork deleted successfully"]);
			} else {
				http_response_code(404);
				echo json_encode(["message" => "Artwork not found"]);
			}
		} catch (PDOException $e) {
			http_response_code(500);
			echo json_encode(["error" => "Failed to delete artwork", "message" => $e->getMessage()]);
		}
	}
?>