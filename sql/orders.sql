create table ORDERS (
    id INT NOT NULL AUTO_INCREMENT,
    customer_id INT,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    address VARCHAR(100) NOT NULL,
    price FLOAT NOT NULL,
    email VARCHAR(100) NOT NULL,
    PRIMARY KEY ( id, product_id )
);