CREATE TABLE products (
  id int NOT NULL AUTO_INCREMENT,
  name varchar(63) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE prices (
  id int NOT NULL AUTO_INCREMENT,
  name varchar(63) NOT NULL,
  price decimal(10,0) NOT NULL,
  product_id int NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (product_id) REFERENCES products (id)
);

INSERT INTO products (id,name) VALUES 
(1, 'Just Java'),
(2, 'Cafe au Lait'),
(3, 'Iced Cappuccino');

INSERT INTO prices (name,price, product_id) VALUES 
('Endless Cup', 2 ,1),
('Single', 2 ,2),
('Double', 3 ,2),
('Single', 4.75 ,3),
('Double', 5.75 ,3);