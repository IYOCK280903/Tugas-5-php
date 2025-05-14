CREATE DATABASE IF NOT EXISTS tugas_php;
USE tugas_php;

DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

INSERT INTO users (username, password) VALUES (
    'admin',
    '$2y$10$5E6rIt3jGUr65tKxGLc0HO6tO7WMeAbCHKrWQHOzTzC2FlOGIgMDm'
);
