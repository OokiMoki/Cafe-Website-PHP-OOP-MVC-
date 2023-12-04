-- Database --
CREATE DATABASE cafe;

-- Use Database --
USE cafe;

-- Breakfast Table --
CREATE TABLE breakfast_menu (
  item_id int(11) NOT NULL,
  name varchar(255) NOT NULL,
  price decimal(10,2) NOT NULL,
  image varchar(255) DEFAULT NULL
);

-- Data in Breakast Table
INSERT INTO breakfast_menu (item_id, name, price, image) VALUES
(1, 'Hotcakes & Sausage', '16.00', 'hotcakes.jpg'),
(2, 'Croissant', '15.00', 'croissant.jpg'),
(3, 'Oatmeal', '14.00', 'oatmeal.jpg'),
(4, 'Eggs and Sausages', '12.00', 'eggs_sausages.jpg');


-- Lunch Table --
CREATE TABLE lunch_menu (
  item_id int(11) NOT NULL,
  name varchar(255) NOT NULL,
  price decimal(10,2) NOT NULL,
  image varchar(255) DEFAULT NULL
);

-- Data in Lunch Table --
INSERT INTO lunch_menu (item_id, name, price, image) VALUES
(1, 'Chicken Sandwich', '16.00', 'chicken_sandwich.jpg'),
(2, 'Salad Bowl', '15.00', 'salad_bowl.jpg'),
(3, 'Tomato Pasta', '14.00', 'tomato_pasta.jpg'),
(4, 'Chicken Noodle Soup', '12.00', 'chicken_noodle_soup.jpg');


-- Dinner Table --
CREATE TABLE dinner_menu(
  item_id int(11) NOT NULL,
  name varchar(255) NOT NULL,
  price decimal(10,2) NOT NULL,
  image varchar(255) DEFAULT NULL
);

-- Data in Dinner Table --
INSERT INTO dinner_menu (item_id, name, price, image) VALUES
(1, 'Chicken Parmesan', '13.00', 'chicken_parmesan.jpg'),
(2, 'Mac and Cheese', '9.00', 'mac_cheese.jpg'),
(3, 'Fish Tacos', '18.00', 'fish_tacos.jpg'),
(4, 'Classic Burger', '11.00', 'classic_burger.jpg');


-- Drinks Table --
CREATE TABLE drinks_menu (
  item_id int(11) NOT NULL,
  name varchar(255) NOT NULL,
  price decimal(10,2) NOT NULL,
  image varchar(255) DEFAULT NULL
);

-- Data in Drinks Table --
INSERT INTO drinks_menu (item_id, name, price, image) VALUES
(1, 'Latte', '6.00', 'latte.jpg'),
(2, 'Cappuccino', '6.00', 'cappuccino.jpg'),
(3, 'Green Tea', '4.00', 'green_tea.jpg'),
(4, 'Black Tea', '4.00', 'black_tea.jpg'),
(5, 'Hot Chocolate', '5.00', 'hot_chocolate.jpg');


-- Employees Table --
CREATE TABLE employees (
  employee_id int(11) NOT NULL,
  first_name varchar(50) DEFAULT NULL,
  last_name varchar(50) DEFAULT NULL,
  username varchar(50) DEFAULT NULL,
  password varchar(255) DEFAULT NULL,
  role varchar(255) NOT NULL
);

-- Data in Employees Table --
INSERT INTO employees (employee_id, first_name, last_name, username, password, role) VALUES
(1, 'Jack', 'Daniels', 'JDANIELS', '$2y$10$UN.QJn65rVZEZcE.BUqdMO5F78Bg0pu.wgkjZnfV68gTWCjQa3ekG', 'manager'),
(2, 'Olivia', 'Carter', 'OCARTER', '$2y$10$54NmtlrgnNy77FWwy/FjUOZBA61RpZwxNhgsDuEA9s1vk95bQwq5u', 'chef'),
(3, 'Ethan', 'Anderson', 'EANDERSON', '$2y$10$LKqLkW4b4A35jEBhnyWUfO/M6DGOlMItUfGwUUp9wef9.hJbNjPc.', 'barista'),
(4, 'Sophia', 'Miller', 'SMILLER', '$2y$10$V9U2vPLjNDfsh5m991BuG.dz9l8t4hWtWBJ1aBrLzv7cspecAUO72', 'waiter'),
(5, 'Liam', 'Johnson', 'LJOHNSON', '$2y$10$o33cBRIRSEXFgaEFJhe0Re9OPnIYbGiiFR0CjTEdXBGsU0brdcYH.', 'barista'),
(6, 'Ava', 'Thompson', 'ATHOMPSON', '$2y$10$wQfnMEBVABvofZ.afGiB/uzVHcenFXZ.E9AAmFqkT9EMceHt.jhiG', 'waiter'),
(7, ' Noah', 'Harris', 'NHARRIS', '$2y$10$2ZWkrWqy9s6VkRW1tUEzo.Tu3CFYCMi2/GA7cjkYevyxYQB/KsZFu', 'barista'),
(8, 'Emma', 'White', 'EWHITE', '$2y$10$6S.A9udD5aRoRELv/F6lI.g872gFePrWEizMIx0KA5yddsYH9Xmoi', 'waiter'),
(9, 'Aiden', 'Martin', 'AMARTIN', '$2y$10$VpEA0oSbZc2lQIYqX0lwZeJUvbcF6.voRL6AHDTRoiuJRLHnaEb/S', 'barista'),
(10, 'Isabella ', 'King', 'IKING', '$2y$10$MPIn0G4ycsBzx9gF3lTXz.SHhzln.wyMfMJBFcpI.2zG0CbttcMLy', 'waiter'),
(11, 'Mason', 'Taylor', 'MTAYLOR', '$2y$10$6jaQzYjlaN/KozxydCv8DOsgJkW05.gAFPqZYhvsO864SHvF/x.1C', 'barista');


-- Timetable Table --
CREATE TABLE time_table (
  id int(11) NOT NULL,
  employee_id int(11) NOT NULL,
  start_date varchar(20) NOT NULL,
  start_time varchar(10) NOT NULL,
  end_time varchar(10) NOT NULL,
  present tinyint(4) NOT NULL DEFAULT 0,
  end_date varchar(20) NOT NULL
);


-- Indexing for Breakfast Table --
Indexes for table breakfast_menu

-- Primary Keys for Database Tables --
ALTER TABLE breakfast_menu
  ADD PRIMARY KEY (item_id);

ALTER TABLE dinner_menu
  ADD PRIMARY KEY (item_id);

ALTER TABLE drinks_menu
  ADD PRIMARY KEY (item_id);

ALTER TABLE employees
  ADD PRIMARY KEY (employee_id);

ALTER TABLE lunch_menu
  ADD PRIMARY KEY (item_id);

ALTER TABLE time_table
  ADD PRIMARY KEY (id);



-- Auto Increment for Database Tables --
ALTER TABLE breakfast_menu
  MODIFY item_id int(11) AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE dinner_menu
  MODIFY item_id int(11) AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE drinks_menu
  MODIFY item_id int(11) AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE employees
  MODIFY employee_id int(11) AUTO_INCREMENT, AUTO_INCREMENT=17;

ALTER TABLE lunch_menu
  MODIFY item_id int(11) AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE time_table
  MODIFY id int(11) AUTO_INCREMENT, AUTO_INCREMENT=8;
