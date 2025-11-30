CREATE TABLE publication (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    picture VARCHAR(255) NOT NULL,
    description TEXT,
    datetime DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    is_published BOOLEAN NOT NULL
);

ALTER TABLE votre_table
MODIFY COLUMN is_published TINYINT(1) NOT NULL DEFAULT 0;

-- Table users
CREATE TABLE users (
    id AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
) 

-- Login
INSERT INTO users(username, email, password)
VALUES("username", "example@user.fr", "$2y$10$fVcspkdGclRx.kelOURoAON04FHu6BcAtvnBVMQLg5emy7.F6sms2");
-- password = Password123!

