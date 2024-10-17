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
    created_at DATETIME CURRENT_TIMESTAMP,
    FOREIGN KEY(artist_id) REFERENCES artists(id);
);

CREATE TABLE exhibitions(
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    artist VARCHAR(100),
    start_date DATE,
    end_date DATE,
    description TEXT,
    location VARCHAR(100),
    created_at TIMESTAMP CURRENT_TIMESTAMP
);

CREATE TABLE exhibition_artworks(
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

CREATE TABLE visitors(
    id AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(15),
    address TEXT,
    feedback TEXT,
    visit_date DATETIME DEFAULT CURRENT_TIMESTAMP
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


