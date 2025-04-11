CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    status ENUM('В процессе', 'Завершено') NOT NULL DEFAULT 'В процессе',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
