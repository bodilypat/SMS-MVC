CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    role ENUM('admin','artist','visitor') DEFAULT 'user'
    created_at DATETIME CURRENT_TIMESTAMP
);

CREATE TABLE artists(
    artist_id INT AUTO_INCREMENT PRIMARY KEY,
    frist_name VARCHAR(100) NOT NULL,
	last_name VARCHAR(100) NOT NULL,
	birth_data DATE,
	death_date DATE DEFAULT NULL,
	biography TEXT,
    biography TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	INDEX idx_name (first_name, last_name),
);

CREATE TABLE artworks(
    id INT AUTO_INCREMENT PRIMA	CRERY KEY,
    title VARCHAR(255) NOT NULL,
    artist_id INT,
    description TEXT,
	medium VARCHAR(100),
	year_created year,
	price DECIMAL(10,2) NOT NULL,
	status ENUM('available','sold','on load' ) DEFAULT 'available',
	image_path VARCHAR(255),
    created_at DATETIME CURRENT_TIMESTAMP,
	updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON DEDATE CURRENT_TIMESTAMP,
    FOREIGN KEY(artist_id) REFERENCES artists(id);
	INDEX (artist_id)
);

CREATE TABLE exhibitions(
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    artist_id INT,
	description TEXT,
	price DECIMAL(10,2) DEFAULT NULL,
	image_path VARCHAR(255),
    created_at TIMESTAMP CURRENT_TIMESTAMP,
	FOREIGN KEY(artist_id) REFERENCES artists(artist_id),
	INDEX idx_artist_id (artist_id)
);

CREATE TABLE artwork_exhibition(
    exhibition_id INT,
    artwork_id INT,
    PRIMARY KEY (exhibition_id, artwork_id),
    
    FOREIGN KEY (exhibition_id) REFERENCES exhibitions(exhibition_id),
    FOREIGN KEY (artwork_id) REFERENCES artworks(artwork_id)
);

CREATE TABLE sales(
    id INT AUTO_INCREMENT PRIMARY KEY,
    artwork_id INT,
    user_id INT,
    sale_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    amount DECIMAL(10,2),

    FOREIGN KEY (artwotk_id) REFERENCES artworks(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) FOREIGN users(id) ON DELETE CASCADE
);
 
CREATE TABLE buyers(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(15),
    feedback TEXT DEFAULT NULL,
    visit_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE inventory (
	product_id INT AUTO_INCREMENT PRIMARY KEY,    
	sku VARCHAR(50) NOT NULL UNIQUE,               
	product_name VARCHAR(255) NOT NULL,            
	description TEXT,                             
	category VARCHAR(100),                        
	quantity INT DEFAULT 0,                       
	price DECIMAL(10,2) NOT NULL,                  
	supplier_id INT,							   
	reorder_level INT DEFAULT 10,                 
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,           
	update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRRENT_TIMESTAMP,  
	FOREIGN KEY (supplier_id) REFERENCES suppliers(supplier_id)
);
CREATE TABLE visitors (
	id INT AUTO_INCREMENT PRIMARY KEY,
	email VARCHAR(150),
	phone VARCHAR(20),
	visit_date DATATIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	exhibition_id INT NOT NULL,
	notes TEXT,
	CONSTRAINT fk_exhibition
	FOREIGN KEY (exhibition_id)
	REFERENCES exhibitions(id)
	ON DELETE CASCADE
);

