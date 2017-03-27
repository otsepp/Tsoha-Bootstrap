-- Lisää INSERT INTO lauseet tähän tiedostoon

INSERT INTO Laitos (nimi) VALUES ('Tietojenkäsittelytieteen laitos');

INSERT INTO Oppilas (laitosID, nimi) VALUES (1, 'Pekka');
INSERT INTO Oppilas (laitosID, nimi) VALUES (1, 'Mauri');
INSERT INTO Opettaja (laitosID, nimi) VALUES (1, 'Arto');
INSERT INTO Opettaja (laitosID, nimi) VALUES (1, 'Jaakko');
INSERT INTO Opettaja (laitosID, nimi) VALUES (1, 'Juuso');
INSERT INTO Opettaja (laitosID, nimi) VALUES (1, 'Kari');
INSERT INTO Vastuuhenkilö (laitosID, nimi) VALUES (1, 'Matti');

INSERT INTO Kurssi (laitosId, opettajaId, nimi) VALUES (1, 1, 'Tietokantojen perusteet');
INSERT INTO Kurssi (laitosId, opettajaId, nimi) VALUES (1, 2, 'Tietokoneen toiminta');
INSERT INTO Kurssi (laitosId, opettajaId, nimi) VALUES (1, 1, 'Webdevving (online course)');
INSERT INTO Kurssi (laitosId, opettajaId, nimi) VALUES (1, 4, 'Game Dev Course');

INSERT INTO Ilmoittautuminen (kurssiID, oppilasID) VALUES (1, 1);
INSERT INTO Ilmoittautuminen (kurssiID, oppilasID) VALUES (2, 2);

INSERT INTO Kysely (kurssiID, oppilasID, kommentti) VALUES (1, 1, 'Tylsä');
INSERT INTO Kysely (kurssiID, oppilasID, kommentti) VALUES (2, 2, 'Opin paljon');

INSERT INTO Kysymys (sisältö) VALUES ('Oliko kurssi vaikea?');
INSERT INTO Kysymys (sisältö) VALUES ('Kuinka hauska kurssi oli?');
INSERT INTO Kysymys (laitosID, sisältö) VALUES (1, 'Opettiko kurssi tkt:sta?');
INSERT INTO Kysymys (kurssiID, sisältö) VALUES (1, 'Oliko ryhmätyö haastava?');

INSERT INTO Vastaus(kyselyID, kysymysID, arvosana) VALUES (1, 1, 4);
INSERT INTO Vastaus(kyselyID, kysymysID, arvosana) VALUES (1, 2, 3);
INSERT INTO Vastaus(kyselyID, kysymysID, arvosana) VALUES (1, 3, 2);
INSERT INTO Vastaus(kyselyID, kysymysID, arvosana) VALUES (1, 4, 3);
INSERT INTO Vastaus(kyselyID, kysymysID, arvosana) VALUES (2, 1, 2);
INSERT INTO Vastaus(kyselyID, kysymysID, arvosana) VALUES (2, 2, 5);
INSERT INTO Vastaus(kyselyID, kysymysID, arvosana) VALUES (2, 3, 4);
INSERT INTO Vastaus(kyselyID, kysymysID, arvosana) VALUES (2, 4, 1);
