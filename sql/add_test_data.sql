-- Lisää INSERT INTO lauseet tähän tiedostoon

INSERT INTO Member (username, password, joined) VALUES ('tero', 'tero1', NOW());
INSERT INTO Member (username, password, joined) VALUES ('kaisa', 'kaisa1', NOW());
INSERT INTO Member (username, password, joined) VALUES ('kai', 'kai1', NOW());
INSERT INTO Member (username, password, joined) VALUES ('suvi', 'suvi1', NOW());

INSERT INTO Topic (user_id, title, published) VALUES 
(1, 'New SLS launcher', NOW());
INSERT INTO Topic (user_id, title, published) VALUES 
(3, 'Jason-3 lands on drone ship', NOW());
INSERT INTO Topic (user_id, title, published) VALUES 
(4, 'Congress increases financing of the comercial crew program', NOW());


INSERT INTO Message (topic_id, user_id, content, published) VALUES 
(1, 1, 'Because it seems that this project start to get realized, I want to give some more detais of this project', NOW());
INSERT INTO Message (topic_id, user_id, content, published) VALUES 
(1, 3, 'These are really fantastic news. Huge thanks from gathering this information.', NOW());
INSERT INTO Message (topic_id, user_id, content, published) VALUES 
(1, 4, 'Excellent work Tero. This staff makes this forum best!!!', NOW());


INSERT INTO Category (name, description) VALUES ('NASA', 'Forefront of space exploration');
INSERT INTO Category (name, description) VALUES ('SpaceX', 'Fastly expanding rocket company owned by Elon musk');
INSERT INTO Category (name, description) VALUES ('ULA', 'Joined venture of Lockheed and Boieng');
INSERT INTO Category (name, description) VALUES ('rocket', 'Tag for topic discussing sertain rocket type(s)');

INSERT INTO Tag (topic_id, category_id) VALUES (1, 1);
INSERT INTO Tag (topic_id, category_id) VALUES (2, 2);
INSERT INTO Tag (topic_id, category_id) VALUES (3, 2);
INSERT INTO Tag (topic_id, category_id) VALUES (1, 4);
