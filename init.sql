-- Creation of 'Users' Table
DROP TABLE Users;
CREATE TABLE Users (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    Username        VARCHAR(25)     NOT NULL ,
    Password        VARCHAR(60)     NOT NULL,
    Creation_Date   DATETIME        NULL
);
INSERT INTO Users (id, username, password, Creation_Date) VALUES (1, 'admin', '$2a$12$y4v2PJQYNLCwpig2D0IhpuSrpiEukeL.O9aKQLsqZPVvd4L5E3lj2', '2025-01-01 12:14:30'); -- Credentials are (admin, admin).
SELECT * FROM Users;

-- Creation of 'Products' Table
DROP TABLE Products;
CREATE TABLE Products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(255) NOT NULL,
    Price DECIMAL(10, 2) NOT NULL,
    Description TEXT NULL,
    Creation_Date DATE NOT NULL,
    Image VARCHAR(255) NULL
);
INSERT INTO Products (id, Name, Price, Image, Creation_Date, Description) VALUES
    (1, 'F-16 Fighting Falcon', 19.99, 'uploads/F-16_Fighting_Falcon.jpg', '1978-08-17', 'An American single-engine supersonic multirole fighter aircraft originally developed by General Dynamics for the United States Air Force (USAF). Designed as an air superiority day fighter, it evolved into a successful all-weather multirole aircraft with over 4,600 built since 1976. Although no longer purchased by the U.S. Air Force, improved versions are being built for export. In 1993, General Dynamics sold its aircraft manufacturing business to the Lockheed Corporation, which became part of Lockheed Martin after a 1995 merger with Martin Marietta.'),
    (2, 'F-22 Raptor', 29.99, 'uploads/F-22_Raptor.jpg', '2005-12-15' ,'An American twin-engine, all-weather, supersonic stealth fighter aircraft. As a product of the United States Air Force''s Advanced Tactical Fighter (ATF) program, the aircraft was designed as an air superiority fighter, but also incorporates ground attack, electronic warfare, and signals intelligence capabilities. The prime contractor, Lockheed Martin, built most of the F-22 airframe and weapons systems and conducted final assembly, while program partner Boeing provided the wings, aft fuselage, avionics integration, and training systems.'),
    (3, 'Mirage 2000', 39.99, 'uploads/Mirage_2000C.jpg', '1978-03-10' ,'A French multirole, single-engine, delta wing, fourth-generation jet fighter manufactured by Dassault Aviation. It was designed in the late 1970s as a lightweight fighter to replace the Mirage III for the French Air Force (Armée de l''air). The Mirage 2000 evolved into a multirole aircraft with several variants developed, with sales to a number of nations. It was later developed into the Mirage 2000N and 2000D strike variants, the improved Mirage 2000-5, and several export variants. Over 600 aircraft were built and it has been in service with nine nations.');
SELECT * FROM Products;

-- Creation of the 'Cart' Table
DROP TABLE Cart;
CREATE TABLE Cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Product_ID INT NOT NULL,
    User_ID INT NOT NULL,
    FOREIGN KEY (Product_ID)    REFERENCES Products(id) ON DELETE CASCADE,
    FOREIGN KEY (User_ID)       REFERENCES Users(id)    ON DELETE CASCADE
);
INSERT INTO Cart (User_ID, Product_ID) VALUES
    (1, 1),
    (1, 2);
SELECT * FROM Cart;