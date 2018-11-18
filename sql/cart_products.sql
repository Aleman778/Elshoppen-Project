CREATE TABLE CART_PRODUCTS (
	customer_id INT(30) UNSIGNED NOT NULL,
    product_id INT(30) UNSIGNED NOT NULL,
    PRIMARY KEY ( customer_id, product_id ),
    FOREIGN KEY ( customer_id ) REFERENCES CART ( customer_id ),
    FOREIGN KEY ( product_id ) REFERENCES PRODUCTS ( id )
);