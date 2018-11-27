create table REVIEWS (
    customer_id INT UNSIGNED NOT NULL,
    product_id INT UNSIGNED NOT NULL,
    rating FLOAT NOT NULL,
    PRIMARY KEY ( product_id, customer_id ),
    FOREIGN KEY ( customer_id ) REFERENCES CUSTOMERS (id),
    FOREIGN KEY ( product_id ) REFERENCES PRODUCTS (id)
);