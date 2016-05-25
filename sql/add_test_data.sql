-- Lisää INSERT INTO lauseet tähän tiedostoon

INSERT INTO Member (username, password, member_from) VALUES ('tero', 'tero1', NOW());
INSERT INTO Member (username, password, member_from) VALUES ('kaisa', 'kaisa1', NOW());
INSERT INTO Member (username, password, member_from) VALUES ('kai', 'kai1', NOW());
INSERT INTO Member (username, password, member_from) VALUES ('suvi', 'suvi1', NOW());

INSERT INTO Topic (member_id, title, published) VALUES 
(1, 'New SLS launcher', NOW());
INSERT INTO Topic (member_id, title, published) VALUES 
(3, 'Jason-3 lands on drone ship', NOW());
INSERT INTO Topic (member_id, title, published) VALUES 
(4, 'Congress increases financing of the comercial crew program', NOW());


INSERT INTO Message (topic_id, member_id, msg, published) VALUES 
(1, 1, 'Because it seems that this project start to get realized, I want to give some more detais of this project', NOW());
INSERT INTO Message (topic_id, member_id, msg, published) VALUES 
(1, 3, 'These are really fantastic news. Huge thanks from gathering this information.', NOW());
INSERT INTO Message (topic_id, member_id, msg, published) VALUES 
(1, 4, 'Excellent work Tero. This staff makes this forum best!!!', NOW());

INSERT INTO Tag (name) VALUES ('NASA');
