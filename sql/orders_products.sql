create table ORDERS_PRODUCTS (
    order_id INT UNSIGNED NOT NULL,
    product_id INT UNSIGNED NOT NULL,
    quantity INT UNSIGNED NOT NULL,
    price INT UNSIGNED NOT NULL,
    PRIMARY KEY ( order_id, product_id ),
    FOREIGN KEY ( order_id ) REFERENCES ORDERS (id),
    FOREIGN KEY ( product_id ) REFERENCES PRODUCTS ( id )
);