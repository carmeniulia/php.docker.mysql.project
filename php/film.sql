

CREATE TABLE kategori (
  kategoriId int NOT NULL,
  namn varchar(255),
  PRIMARY KEY (kategoriId)
) ;

insert into kategori (kategoriId, namn) values(1,"Action"),(2,"Comedy") (3,"Serie");


CREATE TABLE film(
	filmId INT NOT NULL AUTO_INCREMENT,
	filmTitle VARCHAR(50),
	filmDescription VARCHAR(200),
	filmDate DATETIME,
    kategoriId int NOT NULL,
	PRIMARY KEY (filmId),
        FOREIGN KEY (kategoriId) 
        REFERENCES kategori(kategoriId)
);

CREATE TABLE customer(
	customerId INT NOT NULL AUTO_INCREMENT,
	customerName VARCHAR(50),
	customerEmail VARCHAR(50),
	customerPassword varchar(255),
	customerDate DATETIME,
	PRIMARY KEY (customerId)
);


