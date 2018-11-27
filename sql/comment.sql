create table COMMENTS (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    customer_id INT UNSIGNED NOT NULL,
    product_id INT UNSIGNED NOT NULL,
    reply_id INT UNSIGNED,
    comment VARCHAR(200) NOT NULL,
    PRIMARY KEY ( id ),
    FOREIGN KEY ( customer_id ) REFERENCES CUSTOMERS (id),
    FOREIGN KEY ( product_id ) REFERENCES PRODUCTS (id)
);