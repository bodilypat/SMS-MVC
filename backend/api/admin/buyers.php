<?php
	header('Content-Type: application/json');
	header('Access-Content-Allow-Orgin: *');
	header('Access-Content-allow-methods: GET, POST, PUT, DELETE');
	header('Access-Control-Allow-Headers: Content-Type');
	
	require 'dbconnect.php'; // Connection database 
	
	$method = $_SERVER['REQUEST_METHOD'];
	$data = json_decode(file_get_contents('php://input'), true);
	
	switch ($method) {
		case 'GET':
			if (isset($_GET['id'])) {
				$stmt = $db_handle->prepare("SELECT * FROM buyers WHERE id = ?");
				$stmt->excute([$_GET['id']]);
				ech json_encode($stmt->fetch(PDO::FETCH_ASSOC));
			} else {
				$stmt = $db_handle->query("SELECT *from boyers");
				echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
			}
			break;
		case 'POST':
			if (isset($data['user_id'], $data['full_name'], $data['email'])) {
				$stmt = $db_handle->prepare("INSERT INTO buyers(user_id, full_name, email, phone_number, address)
				                             VALUES (?, ?, ?, ?)");
				$stmt->execute([
							$data['user_id'],
							$data['full_name'],
							$data['email'],
							$data['phone_number'] ?? null,
							$data['address'] ?? null
						]);
						echo json_encode(['message' => 'Buyer created successfully']);
					} else {
						http_response_code(400);
						echo json_encode(['error' => 'Missing required fields']);
					}
					break;
		case 'PUT':
			if (!isset($_GET['id'])) {
				http_response_code(400);
				echo json_encode(['error' => 'Buyer ID required']); 
				exit;
			}
			$stmt = $db_handle->prepare("UPDATE buyers SET full_name = ?, email = ?, phone_number = ?, address = ? WHERE id = ?");
			$stmt->execute([
						$data['full_name'] ?? '',
						$data['email'] ?? '',
						$data['phone_number'] ?? null,
						$data['address'] ?? null,
						$_GET['id']
					]);
					echo json_encode(['message'] => 'Buyer updated successfully']);
					break;
		case 'DELETE':
			if (!isset($_GET['id'])) {
				http_response_code(400);
				echo json_encode(['error' => 'Buyer ID required']);
				exit;
			}
			
			$stmt = $db_handle->prepare("DELETE FROM buyers WHERE id = ?");
			$stmt->execute([$_GET['id']]);
			echo json_encode(['message' => 'buyer deleted successfully']);
			break;
		default:
			http_response_code(405);
			echo json_encode(['error' => 'Method Not Allowed']);
	}
	