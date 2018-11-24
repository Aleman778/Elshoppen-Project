create table COMMENTS (
    id INT NOT NULL AUTO_INCREMENT,
    customer_id INT NOT NULL,
    product_id INT NOT NULL,
    reply_id INT,
    comment VARCHAR(200) NOT NULL,
    PRIMARY KEY ( id ),
    FOREIGN KEY ( customer_id ) REFERENCES CUSTOMERS (id),
    FOREIGN KEY ( product_id ) REFERENCES PRODUCTS (id)
);