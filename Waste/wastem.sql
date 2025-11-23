-- Create the database if it does not exist
CREATE DATABASE IF NOT EXISTS garbage;

-- Use the newly created database
USE garbage;

-- Table for Admin accounts
CREATE TABLE IF NOT EXISTS admins (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert a test admin (for example purposes)
INSERT INTO admins (username, password) VALUES
('admin', MD5('admin123')),
('collector1', MD5('collector123')),
('collector2', MD5('collector456'));

-- Table for User accounts
CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('active', 'deactivated') DEFAULT 'active' -- Added status column
);

-- Insert some sample users for testing purposes
INSERT INTO users (username, password, email) VALUES
('user1', MD5('user123'), 'user1@example.com'),
('user2', MD5('user456'), 'user2@example.com');

-- Table for waste collection (tracks waste data for users)
CREATE TABLE IF NOT EXISTS waste_collection (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NOT NULL,
    address VARCHAR(255) NOT NULL,         -- Column for address
    zone VARCHAR(100) NOT NULL,            -- Column for zone
    waste_type VARCHAR(100) NOT NULL,      -- Column for waste type
    collection_date DATE NOT NULL,         -- Column for collection date
    amount DECIMAL(10, 2) NOT NULL,        -- Column for amount (kg)
    description TEXT,                      -- Column for description
    payment_mode ENUM('cash', 'online') NOT NULL,  -- Column for payment mode
    image VARCHAR(255),                    -- Column for image file path
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',  -- Column for status
    collector_id INT(11) DEFAULT NULL,     -- New column for collector assignment (null means not assigned yet)
    payment_status ENUM('pending', 'paid', 'failed') DEFAULT 'pending',  -- Added payment status column
    transaction_id VARCHAR(100) DEFAULT NULL,  -- Added transaction_id for payment
    payment_date TIMESTAMP NULL DEFAULT NULL,  -- Added payment_date to store payment timestamp
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (collector_id) REFERENCES admins(id) ON DELETE SET NULL  -- Link to the admin (collector)
);

-- Insert some sample waste collection requests
INSERT INTO waste_collection (user_id, address, zone, waste_type, collection_date, amount, description, payment_mode, status, collector_id) VALUES
(1, '123 Main St, City', 'Zone A', 'Plastic', '2025-04-10', 10.5, 'Household waste', 'cash', 'pending', NULL),
(2, '456 Oak St, City', 'Zone B', 'Organic', '2025-04-11', 15.0, 'Garden waste', 'online', 'pending', NULL);

-- Table for Waste Categories (types of waste)
CREATE TABLE IF NOT EXISTS waste_categories (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL UNIQUE,  -- Name of the category
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Timestamp of when the category was added
);

-- Insert some sample waste categories for testing purposes
INSERT INTO waste_categories (category_name) VALUES
('Plastic'),
('Paper'),
('Organic'),
('Glass'),
('Metal');

-- Table for pending waste collection requests (to track pending requests separately)
CREATE TABLE IF NOT EXISTS pending_requests (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NOT NULL,
    address VARCHAR(255) NOT NULL,
    zone VARCHAR(100) NOT NULL,
    waste_type VARCHAR(100) NOT NULL,
    collection_date DATE NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    description TEXT,
    payment_mode ENUM('cash', 'online') NOT NULL,
    image VARCHAR(255),
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    collector_id INT(11) DEFAULT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (collector_id) REFERENCES admins(id) ON DELETE SET NULL
);

-- Insert some sample pending waste collection requests
INSERT INTO pending_requests (user_id, address, zone, waste_type, collection_date, amount, description, payment_mode, status, collector_id) VALUES
(1, '123 Main St, City', 'Zone A', 'Plastic', '2025-04-10', 10.5, 'Household waste', 'cash', 'pending', NULL),
(2, '456 Oak St, City', 'Zone B', 'Organic', '2025-04-11', 15.0, 'Garden waste', 'online', 'pending', NULL);

-- Table for Collecting Payments
CREATE TABLE IF NOT EXISTS payments (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    collection_id INT(11) NOT NULL,
    payment_amount DECIMAL(10, 2) NOT NULL,
    payment_status ENUM('pending', 'paid', 'failed') DEFAULT 'pending',
    transaction_id VARCHAR(100) DEFAULT NULL,
    payment_date TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (collection_id) REFERENCES waste_collection(id) ON DELETE CASCADE
);

-- Insert some sample payment records
INSERT INTO payments (collection_id, payment_amount, payment_status, transaction_id, payment_date) VALUES
(1, 10.5, 'pending', NULL, NULL),
(2, 15.0, 'pending', NULL, NULL);

