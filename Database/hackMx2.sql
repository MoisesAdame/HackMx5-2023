-- drop database hack2MX;

# Create database and usage of database.
CREATE database hack2MX;
use hack2MX;
# Creation of tables.
CREATE TABLE participantes
(
	idParticipante char(8),
	nombre varchar(100),
	apellidos varchar(200),
	telefono int,
	escuela varchar(100),
	correo  varchar(100),
	estado varchar(100),
	nivel_estudios varchar(50),
	sexo char(1),

	# Primary key of the table.
	PRIMARY KEY (idParticipante)
);

CREATE TABLE participantes_tec
(
	idParticipante char(8),
	campus varchar(120),
	semestre int,

	# Primary key and foreign key of the table.
	PRIMARY KEY (idParticipante),
	FOREIGN KEY (idParticipante) REFERENCES participantes(idParticipante)
);

CREATE TABLE confirmacion_datos
(
	idParticipante  char(8),
	link_credencial int(1),
	link_carta int(1),

	# Primary keys and foreign keys of the table.
	PRIMARY KEY (idParticipante),
	FOREIGN KEY (idParticipante) REFERENCES participantes(idParticipante)
);

CREATE TABLE equipos_hackmx
(
	idEquipo  char(8),
	nombre_equipo varchar(250) UNIQUE,
	password_equipo varchar(250),

	# Primary key of the table
	PRIMARY KEY (idEquipo)
);

CREATE TABLE miembros_equipo
(
	idEquipo  char(8),
	idParticipante  char(8),

	# Primary keys of the table.
	PRIMARY KEY (idEquipo, idParticipante),
	FOREIGN KEY (idEquipo) REFERENCES equipos_hackmx(idEquipo),
	FOREIGN KEY (idParticipante) REFERENCES participantes(idParticipante)
);

CREATE TABLE carta_responsabilidad
(
	idParticipante char(8),
	nombre_aseguradora varchar(250),
	numero_poliza_seguro varchar(150),
	carrera varchar(150),
	contacto_emergencia varchar(250),
	numero_emergencia int,

	#Primary keys and foreign keys of the table.
	PRIMARY KEY (idParticipante),
	FOREIGN KEY (idParticipante) REFERENCES participantes(idParticipante) ON DELETE CASCADE
);
