create table ORDERS (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    customer_id INT UNSIGNED,
    address VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    PRIMARY KEY ( id ),
    FOREIGN KEY (customer_id) REFERENCES CUSTOMERS (id)
);