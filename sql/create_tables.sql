
CREATE TABLE Member(
    id SERIAL PRIMARY KEY,
    username varchar(15) NOT NULL,
    password varchar(30) NOT NULL,
    joined DATE
);

CREATE TABLE Topic(
    id SERIAL PRIMARY KEY,
    user_id INTEGER REFERENCES Member(id),
    title varchar(100) NOT NULL,
    published DATE
);

CREATE TABLE Message(
    id SERIAL PRIMARY KEY,
    topic_id INTEGER REFERENCES Topic(id),
    user_id INTEGER REFERENCES Member(id),
    content TEXT NOT NULL,
    published DATE
);

CREATE TABLE Category(
    id SERIAL PRIMARY KEY,
    name varchar(20) NOT NULL,
    description varchar(150)
);    

CREATE TABLE Tag(
    id SERIAL PRIMARY KEY,
    topic_id INTEGER REFERENCES Topic(id),
    category_id INTEGER REFERENCES Category(id)
);
