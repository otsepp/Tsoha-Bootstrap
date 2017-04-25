INSERT INTO Laitos (nimi) VALUES ('Tietojenkäsittelytieteen laitos');
INSERT INTO Laitos (nimi) VALUES ('Historian laitos');

INSERT INTO Oppilas (laitos_id, nimi, salasana) VALUES (1, 'Pekka', 'ssana');
INSERT INTO Oppilas (laitos_id, nimi, salasana) VALUES (1, 'Mauri', 'ssana');

INSERT INTO Opettaja (laitos_id, nimi, salasana) VALUES (1, 'Arto', 'ssana');
INSERT INTO Opettaja (laitos_id, nimi, salasana) VALUES (1, 'Jaakko', 'ssana');
INSERT INTO Opettaja (laitos_id, nimi, salasana) VALUES (2, 'Juuso', 'ssana');
INSERT INTO Opettaja (laitos_id, nimi, salasana) VALUES (2, 'Kari','ssana');

INSERT INTO Vastuuhenkilo (laitos_id, nimi, salasana) VALUES (1, 'Matti', 'ssana');
INSERT INTO Vastuuhenkilo (laitos_id, nimi, salasana) VALUES (2, 'Tuomas', 'ssana');

INSERT INTO Kurssi (laitos_id, opettaja_id, nimi, kysely_kaynnissa) VALUES (1, 1, 'Tietokantojen perusteet', 1);
INSERT INTO Kurssi (laitos_id, opettaja_id, nimi, kysely_kaynnissa) VALUES (1, 2, 'Tietokoneen toiminta', 1);
INSERT INTO Kurssi (laitos_id, opettaja_id, nimi) VALUES (1, 1, 'Webdevving (online course)');
INSERT INTO Kurssi (laitos_id, opettaja_id, nimi) VALUES (1, 2, 'Game Dev Course');
INSERT INTO Kurssi (laitos_id, opettaja_id, nimi, kysely_kaynnissa) VALUES (2, 3, 'Barokkiajan taide & muoti', 1);
INSERT INTO Kurssi (laitos_id, opettaja_id, nimi) VALUES (2, 4, 'Toinen maailmansota');

INSERT INTO Ilmoittautuminen (kurssi_id, oppilas_id) VALUES (1, 1);
INSERT INTO Ilmoittautuminen (kurssi_id, oppilas_id) VALUES (2, 2);
INSERT INTO Ilmoittautuminen (kurssi_id, oppilas_id) VALUES (1, 2);

INSERT INTO Kysely (kurssi_id, oppilas_id, kommentti) VALUES (1, 1, 'Tylsä'); 
INSERT INTO Kysely (kurssi_id, oppilas_id, kommentti) VALUES (2, 2, 'Opin paljon'); 

INSERT INTO Kysymys (sisalto) VALUES ('Oliko kurssi vaikea?');
INSERT INTO Kysymys (sisalto) VALUES ('Kuinka hauska kurssi oli?');
INSERT INTO Kysymys (laitos_id, sisalto) VALUES (1, 'Opettiko kurssi tkt:sta?');
INSERT INTO Kysymys (kurssi_id, sisalto) VALUES (1, 'Oliko ryhmätyö haastava?');
INSERT INTO Kysymys (laitos_id, sisalto) VALUES (2, 'Opitko paljon historiaa?');

INSERT INTO Vastaus(kysely_id, kysymys_id, arvosana) VALUES (1, 1, 4);
INSERT INTO Vastaus(kysely_id, kysymys_id, arvosana) VALUES (1, 2, 3);
INSERT INTO Vastaus(kysely_id, kysymys_id, arvosana) VALUES (1, 3, 2);
INSERT INTO Vastaus(kysely_id, kysymys_id, arvosana) VALUES (1, 4, 3);

INSERT INTO Vastaus(kysely_id, kysymys_id, arvosana) VALUES (2, 1, 2);
INSERT INTO Vastaus(kysely_id, kysymys_id, arvosana) VALUES (2, 2, 5);
INSERT INTO Vastaus(kysely_id, kysymys_id, arvosana) VALUES (2, 3, 4);
