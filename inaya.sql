create database if not exists inaya;
use inaya;

create table if not exists roles(
  id int(4) auto_increment primary key,
  name varchar(15),
  created_at datetime default(current_timestamp),
  updated_at datetime default(current_timestamp)
);

insert into roles (name) value ('Administrador');
insert into roles (name) value ('Comerciante');
insert into roles (name) value ('Usuario');

create table if not exists categories(
  id int(4) auto_increment primary key,
  name varchar(50) unique,
  img varchar(255) unique,
  created_at datetime default(current_timestamp),
  updated_at datetime default(current_timestamp)
);

insert into categories (name, img) value ('Restaurantes', './vistas/img/categories/icon1.png');
insert into categories (name, img) value ('Ocio', './vistas/img/categories/icon2.png');
insert into categories (name, img) value ('Moda', './vistas/img/categories/icon3.png');
insert into categories (name, img) value ('Hoteles', './vistas/img/categories/icon4.png');

create table if not exists social_networks(
  id int(4) auto_increment primary key,
  name varchar(50) unique,
  logo varchar(50) unique,
  created_at datetime default(current_timestamp),
  updated_at datetime default(current_timestamp)
);

insert into social_networks (name, logo) value ('Facebook', './vistas/img/socialNetworks/facebook.jpg');
insert into social_networks (name, logo) value ('Twitter', './vistas/img/socialNetworks/twitter.png');
insert into social_networks (name, logo) value ('Instagram', './vistas/img/socialNetworks/instagram.png');
insert into social_networks (name, logo) value ('Web', './vistas/img/socialNetworks/google.png' );

create table if not exists users(
  id int(4) auto_increment primary key,
  dni varchar(9) not null unique,
  name varchar(50) not null,
  email varchar(50) not null,
  password varchar(255)not null,
  id_role int(4),
  created_at datetime default(current_timestamp),
  updated_at datetime default(current_timestamp),

  constraint fk_role foreign key (id_role) references roles(id)
);

insert into users (dni, name, email, password, id_role) value ('29628253K', 'Victoria Almeida Calderon', 'viky2000.22@gmail.com', '$2y$10$1I247TMs0jORANsj2hyVG.E4LcwtH8vyvQ7Y91SWRUEISwMGDYmtK', 1);
insert into users (dni, name, email, password, id_role) value ('62165091R', 'Victoria Almeida Calderon', 'victoria.almeida.calderon@gmail.com', '$2y$10$1I247TMs0jORANsj2hyVG.E4LcwtH8vyvQ7Y91SWRUEISwMGDYmtK', 2);
insert into users (dni, name, email, password, id_role) value ('55762442T', 'Victoria Almeida Calderon', 'victoria.almeida.calderon@ieslaarboleda.com', '$2y$10$1I247TMs0jORANsj2hyVG.E4LcwtH8vyvQ7Y91SWRUEISwMGDYmtK', 3);


create table if not exists establisments(
  id int(4) auto_increment primary key,
  name varchar(50)not null unique,
  location varchar(100)not null unique,
  slug varchar(50)not null unique,
  description varchar(255)not null,
  id_category int(4),
  id_owner int(4) default 2,
  created_at datetime default(current_timestamp),
  updated_at datetime default(current_timestamp),

  constraint fk_owner foreign key (id_owner) references users(id),
  constraint fk_category foreign key (id_category) references categories(id)
);

insert into establisments (description, name, location, slug, id_category) value ('description ','The Jungle - Lounge Bar', 'Av. de Villa Real de San Antonio, 3, 21400 Ayamonte, Huelva', 'jungle-bar', 2);
insert into establisments (description, name, location, slug, id_category) value ('description ','Café Bávaro Coffee', 'Calle Enrique Villegas Vélez, 9, 21400 Ayamonte, Huelva', 'cafe-bavaro', 2);
insert into establisments (description, name, location, slug, id_category) value ('description ','Sala saona', 'C/ Médico Rey García', 'sala-saona', 2);
insert into establisments (description, name, location, slug, id_category) value ('description ','Galerias Abreu', 'P.º de la Ribera, 4, 21400 Ayamonte, Huelva', 'galerias-abreu', 3);
insert into establisments (description, name, location, slug, id_category) value ('description ','lefties', ' C.C. La Plaza, Av. de la Constitución, 6, 21400 Ayamonte, Huelva', 'lefties', 3);
insert into establisments (description, name, location, slug, id_category) value ('description ','Mesón Bar La Ribera', 'P.º de la Ribera, 2, 21400 Ayamonte, Huelva', 'ribera-bar', 1);
insert into establisments (description, name, location, slug, id_category) value ('description ','Playa canela Hotel 4*', 'Av. de la Mojarra, 0, 21409, Huelva', 'playa-canela', 4);

create table if not exists establisments_image(
  id int(4) auto_increment primary key,
  img varchar(255)not null unique,
  id_establishment int(4),
  favorite boolean default(false),
  created_at datetime default(current_timestamp),
  updated_at datetime default(current_timestamp),
  constraint fk_establishmentByImage foreign key (id_establishment) references establisments(id)
);

insert into establisments_image (img, id_establishment, favorite) value ('./vistas/img/ayamonte/establisment/jungleLogo.png',1,true);
insert into establisments_image (img, id_establishment, favorite) value ('./vistas/img/ayamonte/establisment/jungle_banner.png',1,false);
insert into establisments_image (img, id_establishment, favorite) value ('./vistas/img/ayamonte/establisment/bavaroLogo.png',2,true);
insert into establisments_image (img, id_establishment, favorite) value ('./vistas/img/ayamonte/establisment/saonaLogo.jpg',3,true);
insert into establisments_image (img, id_establishment, favorite) value ('./vistas/img/ayamonte/establisment/galeriasAbreu.jpg',4,true);
insert into establisments_image (img, id_establishment, favorite) value ('./vistas/img/ayamonte/establisment/leftiesLogo.png',5,true);
insert into establisments_image (img, id_establishment, favorite) value ('./vistas/img/ayamonte/establisment/riberaLogo.png',6,true);
insert into establisments_image (img, id_establishment, favorite) value ('./vistas/img/ayamonte/establisment/hotelPlayaCanelaLogo.png',7,true);

create table if not exists sections(
  id int(4) auto_increment primary key,
  name varchar(50)not null unique,
  file varchar(255)not null unique,
  created_at datetime default(current_timestamp),
  updated_at datetime default(current_timestamp)
);

insert into sections (name, file) value ('banner', './vistas/modulos/sections/banner.php');
insert into sections (name, file) value ('reservar', './vistas/modulos/sections/reservar.php');
insert into sections (name, file) value ('galery', './vistas/modulos/sections/gallery.php');
insert into sections (name, file) value ('catalogo', './vistas/modulos/sections/catalogo.php');

create table if not exists formats(
  id int(4) auto_increment primary key,
  name varchar(50)not null unique,
  created_at datetime default(current_timestamp),
  updated_at datetime default(current_timestamp)
);

insert into formats (name) value ('Imagenes');
insert into formats (name) value ('Titulos');
insert into formats (name) value ('Subtitulos');
insert into formats (name) value ('Listado');
insert into formats (name) value ('Menu');

create table if not exists datas(
  id int(4) auto_increment primary key,
  datum varchar(50)not null unique,
  id_establishment int(4),
  created_at datetime default(current_timestamp),
  updated_at datetime default(current_timestamp),
  constraint fk_establishmentByDatas foreign key (id_establishment) references establisments(id)
);

create table if not exists visits(
  id int(4) auto_increment primary key,
  id_user int(4),
  id_establishment int(4),
  date_of_booking datetime,
  created_at datetime default(current_timestamp),
  updated_at datetime default(current_timestamp),

  constraint fk_user_visit foreign key (id_user) references users(id),
  constraint fk_establishment_visit foreign key (id_establishment) references establisments(id)
);

insert into visits (id_user,id_establishment,date_of_booking) value (1,1,current_timestamp);
insert into visits (id_user,id_establishment,date_of_booking) value (1,1,null);
insert into visits (id_user,id_establishment,date_of_booking) value (1,1,null);
insert into visits (id_user,id_establishment,date_of_booking) value (1,2,current_timestamp);
insert into visits (id_user,id_establishment,date_of_booking) value (1,6,null);
insert into visits (id_user,id_establishment,date_of_booking) value (3,2,null);
insert into visits (id_user,id_establishment,date_of_booking) value (3,3,current_timestamp());
insert into visits (id_user,id_establishment,date_of_booking) value (2,1,null);
insert into visits (id_user,id_establishment,date_of_booking) value (3,6,null);
insert into visits (id_user,id_establishment,date_of_booking) value (3,1,null);
insert into visits (id_user,id_establishment,date_of_booking) value (1,2,null);

create table if not exists social_networks_by_establisment (
  id_socialNetwork int(4),
  id_establishment int(4),
  created_at datetime default(current_timestamp),
  updated_at datetime default(current_timestamp),

  constraint fk_socialNetwork foreign key (id_socialNetwork) references social_networks(id),
  constraint fk_establishmentBySocialNetwork foreign key (id_establishment) references establisments(id),
  constraint pk_user_establisment PRIMARY KEY (id_socialNetwork, id_establishment)
);

create table if not exists format_by_section (
  id_format int(4),
  id_section int(4),
  occurrence_of_the_format int(4),
  created_at datetime default(current_timestamp),
  updated_at datetime default(current_timestamp),

  constraint fk_format foreign key (id_format) references formats(id),
  constraint fk_section foreign key (id_section) references sections(id),
  constraint pk_user_establisment PRIMARY KEY (id_format, id_section)
);

insert into format_by_section (id_format,id_section) value (1,1);
insert into format_by_section (id_format,id_section) value (2,1);

create table if not exists category_by_section (
  id_category int(4),
  id_section int(4),
  created_at datetime default(current_timestamp),
  updated_at datetime default(current_timestamp),

  constraint fk_categoryXsection foreign key (id_category) references categories(id),
  constraint fk_sectionXcategory foreign key (id_section) references sections(id),
  constraint pk_categoryXsection PRIMARY KEY (id_category, id_section)
);

insert into category_by_section (id_category,id_section) value (1,1);
insert into category_by_section (id_category,id_section) value (2,1);
insert into category_by_section (id_category,id_section) value (3,1);
insert into category_by_section (id_category,id_section) value (4,1);
insert into category_by_section (id_category,id_section) value (1,2);
insert into category_by_section (id_category,id_section) value (2,2);
insert into category_by_section (id_category,id_section) value (4,2);

create table if not exists styles (
  id_format int(4),
  id_establishment int(4),
  id_section int(4),
  datum varchar(255),
  created_at datetime default(current_timestamp),
  updated_at datetime default(current_timestamp),

  constraint fk_format_section_datum foreign key (id_format) references formats(id),
  constraint fk_section_format_datum foreign key (id_section) references sections(id),
  constraint fk_establishments_section_format foreign key (id_establishment) references establisments(id),
  constraint pk_datas_sections_formats PRIMARY KEY (id_format, id_section, id_establishment)
);

insert into styles (id_format,id_establishment,id_section,datum) value (1,1,1,'./vistas/img/ayamonte/establisment/jungle_banner.png');
insert into styles (id_format,id_establishment,id_section,datum) value (2,1,1,'The Jungle - Lounge Bar');