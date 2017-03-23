-- Lisää INSERT INTO lauseet tähän tiedostoon

INSERT INTO Laitos (nimi) VALUES ('Tietojenkäsittelytieteen laitos');

INSERT INTO Oppilas (laitosID, nimi) VALUES (1, 'Pekka');
INSERT INTO Opettaja (laitosID, nimi) VALUES (1, 'Arto');
INSERT INTO Vastuuhenkilö (laitosID, nimi) VALUES (1, 'Matti');

INSERT INTO Kurssi (laitosId, opettajaId, nimi) VALUES (1, 1, 'Tietokantojen perusteet');
INSERT INTO Ilmoittautuminen (kurssiID, oppilasID) VALUES (1, 1);


INSERT INTO Kysely (kurssiID, oppilasID, kommentti) VALUES (1, 1, 'Tylsä');

INSERT INTO Kysymys (sisältö) VALUES ('Oliko kurssi vaikea?');
INSERT INTO Kysymys (laitosID, sisältö) VALUES ('1, Opettiko kurssi tkt:sta?');
INSERT INTO Kysymys (kurssiID, sisältö) VALUES ('1, Oliko ryhmätyö haastava?');

INSERT INTO Kyselynkysymys(kyselyID, kysymysID, arvosana) VALUES (1, 1, 4);
INSERT INTO Kyselynkysymys(kyselyID, kysymysID, arvosana) VALUES (1, 2, 3);
INSERT INTO Kyselynkysymys(kyselyID, kysymysID, arvosana) VALUES (1, 3, 2);
