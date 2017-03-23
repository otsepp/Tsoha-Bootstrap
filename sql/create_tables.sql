-- Lisää CREATE TABLE lauseet tähän tiedostoon

CREATE TABLE Laitos (
	id SERIAL PRIMARY KEY,
	nimi varchar(50) NOT NULL
);


CREATE TABLE Oppilas (
	id SERIAL PRIMARY KEY,
	laitosID INTEGER REFERENCES Laitos(id),
	nimi varchar(50) NOT NULL
);

CREATE TABLE Opettaja (
	id SERIAL PRIMARY KEY,
	laitosID INTEGER REFERENCES Laitos(id),
	nimi varchar(50) NOT NULL
);

CREATE TABLE Vastuuhenkilö (
	id SERIAL PRIMARY KEY,
	laitosID INTEGER REFERENCES Laitos(id),
	nimi varchar(50) NOT NULL
);


CREATE TABLE Kurssi (
	id SERIAL PRIMARY KEY,
	laitosID INTEGER REFERENCES Laitos(id),
	opettajaID INTEGER REFERENCES Opettaja(id),
	nimi varchar(50) NOT NULL
);

CREATE TABLE Ilmoittautuminen (
	kurssiID INTEGER REFERENCES Kurssi(id),
	oppilasID INTEGER REFERENCES Oppilas(id)
);


CREATE TABLE Kysely (
	id SERIAL PRIMARY KEY,
	kurssiID INTEGER REFERENCES Kurssi(id),
	oppilasID INTEGER REFERENCES Oppilas(id),
	kommentti varchar(500) NOT NULL
);

CREATE TABLE Kysymys (
	id SERIAL PRIMARY KEY,
	laitosID INTEGER REFERENCES Laitos(id),
	kurssiID INTEGER REFERENCES Kurssi(id),
	sisaltö varchar(200) NOT NULL
);

CREATE TABLE Kyselynkysymys (
	kyselyID INTEGER REFERENCES Kysely(id),
	kysymysID INTEGER REFERENCES Kysymys(id), 
	arvosana INTEGER NOT NULL
);







