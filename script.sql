--DROP database bd_keiron;
--CREATE DATABASE bd_keiron CHARACTER SET =UTF8 COLLATE=UTF8_SPANISH_CI;

--CREATE USER 'userKieron'@'localhost' IDENTIFIED WITH mysql_native_password BY 'K31r0n*2O2O';
--grant select,insert,update on bd_keiron.* to 'userKieron'@'localhost';
USE bd_keiron;

--  tipo_usuario: id, nombre
CREATE TABLE tp_tipo_usuario(
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY  NOT NULL,
	nombre VARCHAR(50)
) ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_spanish_ci;

--  usuarios: id, id_tipouser, nombre, mail, pass
CREATE TABLE tb_usuarios(
	id INT(11) unsigned PRIMARY KEY AUTO_INCREMENT NOT null,
	id_tipo_usuario INT(11) UNSIGNED NOT null,
	nombre VARCHAR(100), 
	mail VARCHAR(200), 
	pass VARCHAR(240),
	FOREIGN KEY (id_tipo_usuario) REFERENCES tp_tipo_usuario(id)
) ENGINE=InnoDB CHARSET=utf8 COLLATE=UTF8_SPANISH_CI;

-- ticket: id , id_user , ticket_pedido
CREATE TABLE tb_ticket(
	id INT(11) UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
	id_user INT(11) UNSIGNED,
	ticket_pedido tinyint(1),
	FOREIGN KEY(id_user) REFERENCES tb_usuarios(id)
) ENGINE=InnoDB CHARSET=utf8 COLLATE=UTF8_SPANISH_CI;

