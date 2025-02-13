DROP TABLE IF EXISTS Users;

CREATE TABLE Users (
    id_user SERIAL PRIMARY KEY,
    firstname VARCHAR(50),
    lastname VARCHAR(50),
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    pseudo VARCHAR(50) UNIQUE,
    role VARCHAR(50)
);

ALTER SEQUENCE users_id_user_seq RESTART WITH 1;

DROP TABLE IF EXISTS Produits;

CREATE TABLE Produits (
    id_produit SERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    category VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255)
);

ALTER SEQUENCE produits_id_produit_seq RESTART WITH 1;

DROP TABLE IF EXISTS MessageContact;

CREATE TABLE MessageContact (
    id_message SERIAL PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    date_envoi TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER SEQUENCE messagecontact_id_message_seq RESTART WITH 1;

INSERT INTO Produits (name, category, description, price, image) VALUES
('The Witcher 3', 'RPG', 'Un jeu d aventure en monde ouvert basé sur l univers de Geralt de Riv.', 29.99, '/image/witcher3.jpg'),
('Cyberpunk 2077', 'Action RPG', 'Un jeu futuriste dans une mégalopole dystopique.', 39.99, '/image/cyberpunk2077.jpg'),
('Minecraft', 'Sandbox', 'Un jeu de construction et d exploration en voxel.', 19.99, '/image/minecraft.jpg'),
('Dark Souls III', 'Action RPG', 'Un jeu exigeant avec un gameplay basé sur la difficulté.', 24.99, '/image/darksouls3.jpg'),
('FIFA 25', 'Sport', 'Le jeu de simulation de football le plus populaire.', 49.99, '/image/fifa25.jpg');
