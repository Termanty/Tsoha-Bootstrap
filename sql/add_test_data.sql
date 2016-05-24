-- Lisää INSERT INTO lauseet tähän tiedostoon

INSERT INTO Member (username, password) VALUES ('tero', 'tero1');
INSERT INTO Member (username, password) VALUES ('kaisa', 'kaisa1');
INSERT INTO Member (username, password) VALUES ('kai', 'kai1');
INSERT INTO Member (username, password) VALUES ('suvi', 'suvi1');

INSERT INTO Topic (member_id, title, published) VALUES 
(1, 'New SLS launcher', NOW());



INSERT INTO Message (topic_id, msg, published) VALUES 
(1, 'Because it seems that this project start to get realized, I want to give some more detais of this project', NOW());

INSERT INTO Tag (name) VALUES ('NASA');
