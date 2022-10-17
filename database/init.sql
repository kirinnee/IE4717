CREATE TABLE products (
  id int NOT NULL AUTO_INCREMENT,
  name varchar(63) NOT NULL,
  description longtext NOT NULL,
  deleted BOOL NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE prices (
  id int NOT NULL AUTO_INCREMENT,
  internalId int NOT NULL,
  version int NOT NULL,
  name varchar(63) NOT NULL,
  price decimal(10,2) NOT NULL,
  product_id int NOT NULL,
  deleted BOOL NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (product_id) REFERENCES products (id)
);

CREATE TABLE transactions (
  id int NOT NULL AUTO_INCREMENT,
  quantity int NOT NULL,
  ts datetime NOT NULL,
  price_id int NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (price_id) REFERENCES prices (id)
);

INSERT INTO products (id,name, description, deleted) VALUES 
(1, 'Just Java', 'Regular house blend, decaffeinated coffee, or flavor of the day.', 0),
(2, 'Cafe au Lait', 'House blended coffee infused into a smooth, steamed milk', 0),
(3, 'Iced Cappuccino','Sweetened espresso blended with icy-cold milk and served in a chilled glass.', 0);

INSERT INTO prices (name, internalId, version, price, deleted, product_id) VALUES 
('Endless Cup', 1, 0, 2, 0, 1),
('Single', 2, 0, 2, 0, 2),
('Double', 3, 0, 3, 0, 2),
('Single', 4, 0, 4.75,  0, 3),
('Double', 5, 0, 5.75,  0, 3);