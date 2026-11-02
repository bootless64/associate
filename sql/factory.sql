create database FP_DB

use FP_DB
go


create table Factory (
FAID int primary key identity(1,1),
FANAME varchar(500) not null,
FASTATUS bit not null,
FACITY varchar(100) not null
)

create table Products (
PRID int primary key identity(1,1),
PRNAME varchar(500) not null,
PRCITY varchar(100) not null,
PRCOLOR varchar(100) not null,
PRWEIGHT DECIMAL(10,2) not null,
)

create table FP(
FAID int not null,
PRID int not null,
QTY int not null,
PRIMARY KEY (FAID, PRID),
FOREIGN KEY (FAID) REFERENCES Factory(FAID) ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (PRID) REFERENCES Products(PRID) ON DELETE CASCADE ON UPDATE CASCADE
)

INSERT INTO Factory (FANAME, FASTATUS, FACITY) VALUES
('Rezavi Co.', 1, 'Tehran'),
('Khazar Food Industries', 0, 'Mashhad'),
('Novin Pakhsh', 1, 'Esfahan'),
('Kimiagaran Mavad', 1, 'Shiraz'),
('Pars Protein', 0, 'Tabriz'),
('Shahd Nabh', 1, 'Karaj'),
('Anjammad Gostar', 1, 'Qom'),
('Tolidie Sausage Bakhsh', 0, 'Tabriz'),
('Basteband Sabziat', 1, 'Kermanshah'),
('Sayadane Jonoub', 0, 'Rasht'),
('KarKhaneh Rab Sazi', 1, 'Ahvaz'),
('Shirin Konandeha', 1, 'Yazd'),
('Faraordeh Hoozi', 0, 'Zanjan'),
('Nooshidani Sahami Bahar', 1, 'Arak'),
('Basteband Esnak', 0, 'Gorgan');

INSERT INTO Products (PRNAME, PRCITY, PRCOLOR, PRWEIGHT) VALUES
('Wheat Flour', 'Tehran', 'Beige', 5.5),
('Apple Juice', 'Mashhad', 'Red', 3.2),
('Cardamom Pods', 'Esfahan', 'Green', 4.7),
('Cheddar Cheese', 'Shiraz', 'Yellow', 2.9),
('Croissant', 'Tabriz', 'Golden', 6.1),
('Coffee Beans', 'Karaj', 'Brown', 5.0),
('Chocolate Bar', 'Qom', 'Dark Brown', 2.5),
('Salt Crackers', 'Kermanshah', 'Light Brown', 7.3),
('Orange Marmalade', 'Rasht', 'Orange', 4.2),
('Berry Jam', 'Yazd', 'Purple', 3.8),
('Beef Jerky', 'Arak', 'Reddish Brown', 5.9),
('Frozen Peas', 'Gorgan', 'Green', 6.4),
('Tomato Paste', 'Tehran', 'Red', 4.1),
('Lemonade', 'Mashhad', 'Yellow', 3.6),
('Sardines', 'Esfahan', 'Silver', 2.8);

INSERT INTO FP (FAID, PRID, QTY) VALUES
(1, 1, 100),
(1, 2, 50),
(2, 3, 70),
(3, 4, 80),
(4, 5, 60),
(5, 6, 90),
(6, 7, 110),
(7, 8, 40),
(8, 9, 55),
(9, 10, 75),
(10, 11, 65),
(11, 12, 85),
(12, 13, 95),
(13, 14, 45),
(14, 15, 105);

select * from Factory
select * from Products
select * from FP
