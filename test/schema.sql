use test;

CREATE TABLE instent_data(
    id INT AUTO_INCREMENT PRIMARY KEY,
    msg text NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT NOW()
);

INSERT INTO instent_data (msg) VALUES('first');