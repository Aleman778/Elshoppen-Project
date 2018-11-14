create table CUSTOMERS (
    lastname VARCHAR(40) NOT NULL,
    firstname VARCHAR(40) NOT NULL,
    password VARCHAR(40) NOT NULL,
    gender CHAR NOT NULL,
    birth_date DATE NOT NULL,
    email VARCHAR(100) NOT NULL,
    removed TINYINT(1) NOT NULL,
    id INT NOT NULL AUTO_INCREMENT,
    phone_number INT,
    address VARCHAR(100),
    PRIMARY KEY ( id )
);