CREATE TABLE players (
    id TINYINT UNSIGNED AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    wins INT,
    losses INT,
    PRIMARY KEY(id)
);

CREATE TABLE matches (
    id TINYINT UNSIGNED AUTO_INCREMENT,
    round INT NOT NULL,
    winner INT NOT NULL,
    loser INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (winner) REFERENCES players(id),
    FOREIGN KEY (loser) REFERENCES players(id)
);