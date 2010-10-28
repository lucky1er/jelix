--
-- PostgreSQL database dump
--

SET client_encoding = 'UTF8';
SET check_function_bodies = false;
SET client_min_messages = warning;
SET search_path = public, pg_catalog;
SET default_tablespace = '';
SET default_with_oids = false;

CREATE TABLE labels_tests (
    "key" integer NOT NULL,
    keyalias VARCHAR( 10 ) NULL,
    lang character varying(5) NOT NULL,
    label character varying(50) NOT NULL
);

CREATE TABLE labels1_tests (
    "key" integer NOT NULL,
    keyalias VARCHAR( 10 ) NOT NULL,
    lang character varying(5) NOT NULL,
    label character varying(50) NOT NULL
);



CREATE TABLE testkvdb (
k_key character varying(255) NOT NULL ,
k_value bytea NOT NULL ,
k_expire time with time zone NOT NULL ,
CONSTRAINT testkvdb_pkey PRIMARY KEY (k_key)
);

CREATE TABLE product_tags_test (
    product_id integer NOT NULL,
    tag character varying(50) NOT NULL
);

CREATE TABLE product_test (
    id serial NOT NULL,
    name character varying(150) NOT NULL,
    price real NOT NULL,
    create_date timestamp with time zone,
    promo boolean NOT NULL
);

SELECT pg_catalog.setval(pg_catalog.pg_get_serial_sequence('product_test', 'id'), 1, false);


CREATE TABLE products (
    id serial NOT NULL,
    name character varying(150) NOT NULL,
    price real DEFAULT 0,
    promo boolean NOT NULL
);

SELECT pg_catalog.setval(pg_catalog.pg_get_serial_sequence('products', 'id'), 1, false);

ALTER TABLE ONLY labels_tests
    ADD CONSTRAINT labels_tests_pkey PRIMARY KEY ("key", lang);
ALTER TABLE ONLY labels_tests
    ADD CONSTRAINT labels_tests_keyalias UNIQUE KEY ("keyalias");

ALTER TABLE ONLY labels1_tests
    ADD CONSTRAINT labels1_tests_pkey PRIMARY KEY ("key");

ALTER TABLE ONLY labels1_tests
    ADD CONSTRAINT labels1_tests_keyalias UNIQUE KEY ("keyalias");


ALTER TABLE ONLY product_tags_test
    ADD CONSTRAINT product_tags_test_pkey PRIMARY KEY (product_id, tag);

ALTER TABLE ONLY product_test
    ADD CONSTRAINT product_test_pkey PRIMARY KEY (id);

ALTER TABLE ONLY products
    ADD CONSTRAINT products_pkey PRIMARY KEY (id);


