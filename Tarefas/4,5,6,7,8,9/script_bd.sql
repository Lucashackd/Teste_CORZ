CREATE DATABASE teste_corz;

USE teste_corz;

CREATE TABLE clients (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(100) NOT NULL,
    email varchar(100) NOT NULL
);

CREATE TABLE invoices (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    emission_date date NOT NULL,
    total_value decimal(10,2) NOT NULL,
    client_id int NOT NULL
);

ALTER TABLE invoices
    ADD CONSTRAINT fk_invoices_clients FOREIGN KEY (client_id)
        REFERENCES clients (id);

CREATE TABLE products (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    unitary_value decimal(10,2) NOT NULL,
    name varchar(100) NOT NULL
);

CREATE TABLE items (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    total_item_value decimal(10,2) NOT NULL,
    amount int NOT NULL,
    invoice_id int NOT NULL,
    product_id int NOT NULL
);

ALTER TABLE items
    ADD CONSTRAINT fk_items_invoices FOREIGN KEY (invoice_id)
        REFERENCES invoices (id) ON DELETE CASCADE,
    ADD CONSTRAINT fk_items_products FOREIGN KEY (product_id)
        REFERENCES products(id) ON DELETE CASCADE;