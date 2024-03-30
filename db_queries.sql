CREATE DATABASE property_rental;
USE property_rental;

CREATE TABLE landlord (
    username VARCHAR(20),
    password VARCHAR(20),
    name VARCHAR(40),

    PRIMARY KEY (username)
);

CREATE TABLE tenant (
    tenant_username VARCHAR(20),
    tenant_password VARCHAR(20),

    tenant_name VARCHAR(30),
    phone_number VARCHAR(15),
    property_rented VARCHAR(20),
    rent INT,
    landlord VARCHAR(20),

    PRIMARY KEY (tenant_username)
);  

CREATE TABLE property (
    property_id INT NOT NULL AUTO_INCREMENT,
    property_name VARCHAR(20),
    property_address VARCHAR(30),
    property_type INT,
    property_status INT,

    caretaker_name VARCHAR(30),
    contact_num VARCHAR(15),
    note VARCHAR(50),
    property_owner VARCHAR(30),

    PRIMARY KEY (property_id)
);

