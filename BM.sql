create database School;

use School

create table etudiant(
    idet int primary key auto_increment,

    matricule varchar(50) not null,
    nom varchar(50) not null,
    prenom varchar(50) not null,
    class varchar(20) not null,
    email varchar(50) not null unique,
    statut varchar(10) not null
);

create table enseignant(
    ide int primary key auto_increment,
    nom varchar(50) not null,
    class varchar(20) not null,
    email varchar(50) not null unique,
    tel int(20) not null unique
);

create table  utilisateurs(
    id int primary key auto_increment,
    email varchar(50) not null unique,
    mot_de_passe varchar(255) not null,
    date_creation timestamp default current_timestamp

);

create table salle(
    ids int primary key auto_increment,
    salle varchar(20) not null,
    class varchar(20) not null
);

insert into salle(salle,class)
values ('Salle1', 'L1'), ('Salle2', 'L2'),
 ('Salle3', 'L3'), ('Salle4', 'M1'),
  ('Salle5', 'M2');

insert into etudiant(matricule, nom, prenom, class, email, statut)
values ('Brama30','Brama', 'Son', 'L3', 'Brama@gmail.com', 'Actif'),
        ('Ahmed31','Ahmed', 'Sega', 'M1', 'ahmed@gmail.com', 'Actif');

insert into enseignant(nom, class, email, tel)
values ('Hassane Omar', 'L3', 'hassane@gmail.com', '78459321'),
('Tahar Modric', 'M1', 'tahar@gmail.com', '78412365');

