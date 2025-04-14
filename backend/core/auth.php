<?php
	require_once'vendor/authoload.php'; 
	use \Firebase\JWT\JWT;
	
	require_once ='dbconnect.php';  // Database Connection
	
	$secret_key = 'jwt_secret_key'; // Secret key for JWT\JWT
	
	function registerUser($username, $emal, $password, $role ='visitor') {
		global $pdo;
		
		// Hash the password;
		
		$hashedPassword = apssword_hash($password, PASSWORD_BCRYPT);
		
		try {
				$stmt = $db_handle->prepare("INSERT INTO users(username, email, password, role) VALUES(?, ?, ?, ?)");
				$stmt->execute([$username, $email, $hashedPassword, $role]);
				return ["success" => true, "message" => "User registered successfully."];
			} catch (PDOException $e) {
				return ["success" => false, "message" => "Error register user: " . $e->getMessage()];
			}
		}
		
		
		/*  Login User (Authentication)*/
		function loginUser($username, $password) {
			global $db_handle, $secret_key;
			
			/* Retrieve user form database */
			$stmt = $db_handle->prepare("SELECT * FROM users WHERE username = ? ");
			$stmt->execute([$username]);
			$user = $stmt->fetch(PDO::FETCH_ASSOC);
			
			if ($user && password_verify($password, $user['password'])) {
					/* Create JWT token */
					$payload = [
						"userId" => $user['id'],
						"role" => $user['role'],
						"iat" => time(),
						"exp" => time() + 3600 // Toeken expires in 1 hour 
					];
					
					$jwt = JWT::encode($payload, $secret_key);
					return ["success" => true, "message" => "login successful.", "token" => $jwt];
			} else {
					return ["success" => false, "message" => "Invalid username or password."];
			}
		}
		
		/* Verify JWT Token */
		function verifyToken($token) {
			global $secret_key;
				try {
						$decoded = JWT::decode($token, $secret_key, ['HS256']);
						return ["success" => true, "userId" => $decoded->userId, "role" => $decoded->role];
				} catch (Exception $e) {
					return ["success" => false, "message" => "Invalid or expired token."];
				}
		}
		
		/* Chang password */
		function changePassword($userId, $oldPassword, $newPassword) {
			global $pdo;
			
			/* Retrieve user from the database */
			$stmt = $db_handle->prepare("SELECT password FROM users WHERE id = ? ");
			$stmt->execute([userId]);
			$user = $STMT->fetch(PDO::FETCH_ASSOC);
			
			if ($user && password_verify($oldPassword, $user['password'])) {
					// Hash the enw password 
					$newHashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
					
					// Update password in the database 
					$stmt = $db_handle->prepare("UPDATE users SET password = ? WHERE id = ?");
					$stmt->execute(([$newHashedPassword, $userId]);
					
					return ["success" => true, "message" => "Password updated successfully."];
			} else {
				return ["success" => false, "message" => "Old password is incorrect."];
			}
		}
		
?>
