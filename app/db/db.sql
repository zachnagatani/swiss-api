CREATE TABLE players (
    id INT(7) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    wins INT,
    losses INT
);

CREATE TABLE matches (
    id INT(7) AUTO_INCREMENT PRIMARY KEY,
    round INT NOT NULL,
    playerOne INT,
    playerTwo INT,
    winner INT,
    loser INT
);