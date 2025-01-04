-- Initialized database with these values, for testing purposes, downloaded images from Wikipedia.

-- Creation of 'Users' Table
# DROP TABLE Users;
# create table Users (
#     id int auto_increment not null primary key,
#     Username varchar(25)  not null,
#     Password      varchar(60) not null,
#     Creation_Date datetime     null
# );
# INSERT INTO Users (id, username, password, Creation_Date) VALUES (1, 'admin', '$2a$12$y4v2PJQYNLCwpig2D0IhpuSrpiEukeL.O9aKQLsqZPVvd4L5E3lj2', '2025-01-01 12:14:30');
# SELECT * FROM Users;

-- Creation of 'Products' Table
# DROP TABLE Products;
# CREATE TABLE Products (
#     id INT AUTO_INCREMENT PRIMARY KEY,
#     Name VARCHAR(255) NOT NULL,
#     Price DECIMAL(10, 2) NOT NULL,
#     Description TEXT NULL,
#     Creation_Date DATE NOT NULL,
#     Image VARCHAR(255) NULL
# );
# INSERT INTO Products (Name, Price, Image, Creation_Date, Description) VALUES
#     ('F-16 Fighting Falcon', 19.99, 'uploads/F-16_Fighting_Falcon.jpg', '1978-08-17', 'An American single-engine supersonic multirole fighter aircraft originally developed by General Dynamics for the United States Air Force (USAF). Designed as an air superiority day fighter, it evolved into a successful all-weather multirole aircraft with over 4,600 built since 1976. Although no longer purchased by the U.S. Air Force, improved versions are being built for export. In 1993, General Dynamics sold its aircraft manufacturing business to the Lockheed Corporation, which became part of Lockheed Martin after a 1995 merger with Martin Marietta.'),
#     ('F-22 Raptor', 29.99, 'uploads/F-22_Raptor.jpg', '2005-12-15' ,'An American twin-engine, all-weather, supersonic stealth fighter aircraft. As a product of the United States Air Force''s Advanced Tactical Fighter (ATF) program, the aircraft was designed as an air superiority fighter, but also incorporates ground attack, electronic warfare, and signals intelligence capabilities. The prime contractor, Lockheed Martin, built most of the F-22 airframe and weapons systems and conducted final assembly, while program partner Boeing provided the wings, aft fuselage, avionics integration, and training systems.'),
#     ('Mirage 2000', 39.99, 'uploads/Mirage_2000C.jpg', '1978-03-10' ,'A French multirole, single-engine, delta wing, fourth-generation jet fighter manufactured by Dassault Aviation. It was designed in the late 1970s as a lightweight fighter to replace the Mirage III for the French Air Force (Armée de l''air). The Mirage 2000 evolved into a multirole aircraft with several variants developed, with sales to a number of nations. It was later developed into the Mirage 2000N and 2000D strike variants, the improved Mirage 2000-5, and several export variants. Over 600 aircraft were built and it has been in service with nine nations.');
# SELECT * FROM Products