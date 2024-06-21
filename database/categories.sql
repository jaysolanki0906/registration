CREATE TABLE Category (
    category_id INT PRIMARY KEY,
    description VARCHAR(255),
    created_at TIMESTAMP,
    created_by INT,
    updated_at TIMESTAMP,
    updated_by INT
);
