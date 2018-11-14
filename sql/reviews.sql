create table REVIEWS (
    customer_id INT NOT NULL,
    product_id INT NOT NULL,
    rating FLOAT NOT NULL,
    comment VARCHAR(200),
    PRIMARY KEY ( product_id, customer_id )
);