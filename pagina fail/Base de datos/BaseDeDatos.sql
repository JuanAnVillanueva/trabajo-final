drop database if exists grupo6;
create database grupo6;
use grupo6;

create table Usuario(
    id integer auto_increment,
    Usuario varchar(25),
    contrasena varchar(25),
    mail varchar(30),
    telefono integer(30),
    primary key (id)
);


create table Proyecto(
    id integer auto_increment,
    id_creador integer,
    nombre varchar(50),
    fecha_ini date,
    fecha_fin date,
    estado varchar(255),
    descripcion varchar(255),
    primary key (id),
    foreign key (id_creador) references Usuario(id)
);

create table Integrantes(
    id integer auto_increment,
    id_Usuario integer,
    id_Proyecto integer,
    rol varchar(50),
    primary key (id),
    foreign key (id_Usuario) references Usuario(id),
    foreign key (id_Proyecto) references Proyecto(id)
);

create table Actividade(
    id integer auto_increment,
    tipo varchar(255),
    contenido varchar(255),
    fecha date,
    id_intgrante integer,
    id_Proyecto integer,
    primary key (id),
    foreign key (id_intgrante) references Integrantes(id),
    foreign key (id_Proyecto) references Proyecto (id) 
);