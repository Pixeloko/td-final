CREATE TABLE publication (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    picture VARCHAR(255) NOT NULL,
    description TEXT,
    datetime DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    is_published BOOLEAN NOT NULL DEFAULT 0
);


-- Table users
CREATE TABLE users (
	id INT PRIMARY KEY AUTO_INCREMENT,
    role enum('user', 'admin') default 'user',
    username varchar(50) unique not null,
    email varchar(50) unique not null,
    password varchar(255) not null,
    admin BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Login
INSERT INTO users(username, email, password)
VALUES("admin", "admin@gmail.com", "$2y$10$fVcspkdGclRx.kelOURoAON04FHu6BcAtvnBVMQLg5emy7.F6sms2");
-- password = Password123!


