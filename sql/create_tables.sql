CREATE TABLE Laitos (
	id SERIAL PRIMARY KEY,
	nimi varchar(50) NOT NULL
);

CREATE TABLE Oppilas (
	id SERIAL PRIMARY KEY,
	laitos_id INTEGER REFERENCES Laitos(id),
	nimi varchar(50) NOT NULL
);

CREATE TABLE Opettaja (
	id SERIAL PRIMARY KEY,
	laitos_id INTEGER REFERENCES Laitos(id),
	nimi varchar(50) NOT NULL
);

CREATE TABLE Vastuuhenkilo (
	id SERIAL PRIMARY KEY,
	laitos_id INTEGER REFERENCES Laitos(id),
	nimi varchar(50) NOT NULL
);


CREATE TABLE Kurssi (
	id SERIAL PRIMARY KEY,
	laitos_id INTEGER REFERENCES Laitos(id),
	opettaja_id INTEGER REFERENCES Opettaja(id),
	nimi varchar(50) NOT NULL,
	kysely_kaynnissa boolean DEFAULT FALSE
);

CREATE TABLE Ilmoittautuminen (
	id SERIAL PRIMARY KEY,
	kurssi_id INTEGER REFERENCES Kurssi(id),
	oppilas_id INTEGER REFERENCES Oppilas(id)
);


CREATE TABLE Kysely (
	id SERIAL PRIMARY KEY,
	kurssi_id INTEGER REFERENCES Kurssi(id),
	oppilas_id INTEGER REFERENCES Oppilas(id),
	kommentti varchar(500)
);

CREATE TABLE Kysymys (
	id SERIAL PRIMARY KEY,
	laitos_id INTEGER REFERENCES Laitos(id),
	kurssi_id INTEGER REFERENCES Kurssi(id),
	sisalto varchar(200) NOT NULL
);

CREATE TABLE Vastaus (
	id SERIAL PRIMARY KEY,
	kysely_id INTEGER REFERENCES Kysely(id),
	kysymys_id INTEGER REFERENCES Kysymys(id), 
	arvosana INTEGER NOT NULL
);







