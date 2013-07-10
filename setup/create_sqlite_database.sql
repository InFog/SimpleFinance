-- This script creates the database

CREATE TABLE movement (
    id          INTEGER         PRIMARY KEY     AUTOINCREMENT,
    date        DATE            NOT NULL,
    amount      DECIMAL(10,2)   NOT NULL,
    name        VARCHAR(20)     NULL,
    description VARCHAR(255)    NULL
);
