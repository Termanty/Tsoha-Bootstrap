-- Lisää CREATE TABLE lauseet tähän tiedostoon

CREATE TABLE Member(
    id SERIAL PRIMARY KEY,
    username varchar(15) NOT NULL,
    password varchar(30) NOT NULL,
    member_from DATE
);


CREATE TABLE Topic(
    id SERIAL PRIMARY KEY,
    member_id INTEGER REFERENCES Member(id),
    title varchar(100) NOT NULL,
    published DATE
);

CREATE TABLE Message(
    id SERIAL PRIMARY KEY,
    topic_id INTEGER REFERENCES Topic(id),
    msg TEXT NOT NULL,
    published DATE
);

CREATE TABLE Tag(
    id SERIAL PRIMARY KEY,
    name varchar(20) NOT NULL,
    description varchar(150)
);
