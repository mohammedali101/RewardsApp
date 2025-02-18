DROP DATABASE IF EXISTS db;

CREATE DATABASE db;

USE db;

CREATE TABLE accounts(
    ID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username varchar(30) UNIQUE NOT NULL,
    password_hash TEXT NOT NULL,
    fname TEXT NOT NULL,
    lNAME TEXT NOT NULL,
    balance int DEFAULT 10
);

CREATE TABLE admins(
    ID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username varchar(30) UNIQUE NOT NULL,
    password_hash TEXT NOT NULL,
    fname TEXT NOT NULL,
    lname TEXT NOT NULL
);
