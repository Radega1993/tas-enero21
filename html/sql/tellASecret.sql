
CREATE TABLE categoria (
    categoriaID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(20) NOT NULL UNIQUE
);

CREATE TABLE post (
    postID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nick VARCHAR(15),
    postText VARCHAR(255) NOT NULL,
    fav int,
    categoriaID int NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (categoriaID) REFERENCES categoria(categoriaID)
);

INSERT INTO `categoria`(`categoriaID`, `name`) VALUES (1,'Amistad');
INSERT INTO `categoria`(`categoriaID`, `name`) VALUES (2,'Picante');
INSERT INTO `categoria`(`categoriaID`, `name`) VALUES (3,'Trabajo');
INSERT INTO `categoria`(`categoriaID`, `name`) VALUES (4,'Escuela');
INSERT INTO `categoria`(`categoriaID`, `name`) VALUES (5,'Amor');
INSERT INTO `categoria`(`categoriaID`, `name`) VALUES (6,'Otros');
