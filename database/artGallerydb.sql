CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    role ENUM('admin','user') DEFAULT 'user'
);

CREATE TABLE artists(
    artist_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    biography TEXT,
    contact_email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE artworks(
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    artist_id INT,
    description TEXT,
    price DECIMAL(10,2),
    image_path VARCHAR(255),
    FOREIGN KEY(artist_id) REFERENCES artists(artist_id);
);

CREATE TABLE exhibitions(
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    artist VARCHAR(100),
    start_date DATE,
    end_date DATE,
    description TEXT,
    created_at TIMESTAMP CURRENT_TIMESTAMP
);

CREATE TABLE exhibition_artworks(
    exhibition_id INT,
    artwork_id INT,
    PRIMARY KEY (exhibition_id, artwork_id),
    FOREIGN KEY (exhibition_id) REFERENCES exhibitions(exhibition_id),
    FOREIGN KEY (artwork_id) REFERENCES artworks(artwork_id)
);

CREATE TABLE buyers(
    id AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(15),
    address TEXT, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


