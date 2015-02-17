--
-- To use this file do either of:
-- - copy/paste all the following code into the mysql client (in terminal)
-- - $ cat schema.sql | mysql -u root
--

DROP DATABASE IF EXISTS pos;
CREATE DATABASE pos;
USE pos;

--
-- Create database tables
--
CREATE TABLE customer (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    email VARCHAR(255),
    gender VARCHAR(50),
    customer_since DATE
);

CREATE TABLE item (
    item_id INT auto_increment primary key,
    name VARCHAR(100),
    price DECIMAL(7,2)
);

CREATE TABLE invoice (
    invoice_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    created_at TIMESTAMP
);

CREATE TABLE invoice_item (
    invoice_item_id INT AUTO_INCREMENT PRIMARY KEY,
    invoice_id INT NOT NULL,
    item_id INT NOT NULL,
    quantity INT
);

--
-- Insert sample data
--

INSERT INTO customer (first_name, last_name, email, gender, customer_since)
    VALUES ('kat', 'jacobs', 'k@jacobs.com', 'female', CURDATE());
INSERT INTO customer (first_name, last_name, email, gender, customer_since)
    VALUES ('sam', 'james', 's@james.com', 'male', CURDATE());
INSERT INTO customer (first_name, last_name, email, gender, customer_since)
    VALUES ('sue', 'watson', 's@watson.com', 'female', CURDATE());
INSERT INTO customer (first_name, last_name, email, gender, customer_since)
    VALUES ('liam', 'smith', 'l@smith.com', 'male', CURDATE());



INSERT INTO item (name, price) VALUES ('hammer', 17.95);
INSERT INTO item (name, price) VALUES ('drill', 49.95);
INSERT INTO item (name, price) VALUES ('saw', 25.27);
INSERT INTO item (name, price) VALUES ('wrench', 14.82);
INSERT INTO item (name, price) VALUES ('screwdriver', 12.95);


INSERT INTO invoice (customer_id, created_at) VALUES (1, NOW());
INSERT INTO invoice (customer_id, created_at) VALUES (2, NOW());
INSERT INTO invoice (customer_id, created_at) VALUES (4, NOW());
INSERT INTO invoice (customer_id, created_at) VALUES (3, NOW());
INSERT INTO invoice (customer_id, created_at) VALUES (5, NOW());
INSERT INTO invoice (customer_id, created_at) VALUES (6, NOW());
INSERT INTO invoice (customer_id, created_at) VALUES (3, NOW());



INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (1, 1, 13);
INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (1, 2, 5);
INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (2, 1, 6);
INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (3, 4, 8);
INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (3, 5, 2);
INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (5, 1, 1);
INSERT INTO invoice_item (invoice_id, item_id, quantity) VALUES (6, 4, 8);
