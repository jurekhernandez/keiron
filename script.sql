-- DROP database bd_keiron;
CREATE DATABASE bd_keiron CHARACTER SET =UTF8 COLLATE=UTF8_SPANISH_CI;
CREATE USER 'userKieron'@'localhost' IDENTIFIED WITH mysql_native_password BY 'K31r0n*2O2O';
 
grant select,insert,update on bd_keiron.* to 'userKieron'@'localhost';
-- grant select on information_schema.* to 'userKieron'@'localhost';

-- GRANT CREATE,ALTER ON bd_keiron.* TO 'userKieron'@'localhost' IDENTIFIED BY 'userKieron';
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
	fecha_eliminacion DATETIME,
	FOREIGN KEY (id_tipo_usuario) REFERENCES tp_tipo_usuario(id)
) ENGINE=InnoDB CHARSET=utf8 COLLATE=UTF8_SPANISH_CI;

-- ticket: id , id_user , ticket_pedido
CREATE TABLE tb_ticket(
	id INT(11) UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
	id_user INT(11) UNSIGNED,
	ticket_pedido tinyint(1) default 0,
	contenido VARCHAR(200),
	fecha_eliminacion DATETIME,
	FOREIGN KEY(id_user) REFERENCES tb_usuarios(id)
) ENGINE=InnoDB CHARSET=utf8 COLLATE=UTF8_SPANISH_CI;

INSERT INTO tp_tipo_usuario VALUES(DEFAULT,'Administrador'),(DEFAULT,'Usuario');



CREATE TABLE `migrations` (
   `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
   `batch` int(11) NOT NULL,
   PRIMARY KEY (`id`)
 ) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
 
 CREATE TABLE `oauth_access_tokens` (
   `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
   `user_id` bigint(20) unsigned DEFAULT NULL,
   `client_id` bigint(20) unsigned NOT NULL,
   `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
   `scopes` text COLLATE utf8mb4_unicode_ci,
   `revoked` tinyint(1) NOT NULL,
   `created_at` timestamp NULL DEFAULT NULL,
   `updated_at` timestamp NULL DEFAULT NULL,
   `expires_at` datetime DEFAULT NULL,
   PRIMARY KEY (`id`),
   KEY `oauth_access_tokens_user_id_index` (`user_id`)
 ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `oauth_auth_codes` (
   `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
   `user_id` bigint(20) unsigned NOT NULL,
   `client_id` bigint(20) unsigned NOT NULL,
   `scopes` text COLLATE utf8mb4_unicode_ci,
   `revoked` tinyint(1) NOT NULL,
   `expires_at` datetime DEFAULT NULL,
   PRIMARY KEY (`id`),
   KEY `oauth_auth_codes_user_id_index` (`user_id`)
 ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
 
 
 CREATE TABLE `oauth_clients` (
   `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
   `user_id` bigint(20) unsigned DEFAULT NULL,
   `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
   `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
   `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
   `personal_access_client` tinyint(1) NOT NULL,
   `password_client` tinyint(1) NOT NULL,
   `revoked` tinyint(1) NOT NULL,
   `created_at` timestamp NULL DEFAULT NULL,
   `updated_at` timestamp NULL DEFAULT NULL,
   PRIMARY KEY (`id`),
   KEY `oauth_clients_user_id_index` (`user_id`)
 ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
 
 CREATE TABLE `oauth_personal_access_clients` (
   `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
   `client_id` bigint(20) unsigned NOT NULL,
   `created_at` timestamp NULL DEFAULT NULL,
   `updated_at` timestamp NULL DEFAULT NULL,
   PRIMARY KEY (`id`)
 ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
 
 CREATE TABLE `oauth_refresh_tokens` (
   `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
   `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
   `revoked` tinyint(1) NOT NULL,
   `expires_at` datetime DEFAULT NULL,
   PRIMARY KEY (`id`)
 ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
 
-- GRANT ALL PRIVILEGES ON *.* TO 'root'@'localhost';
 -- grant all privileges on *.* to 'root'@'localhost' identified by '' with grant option;
-- UPDATE tb_usuarios SET fecha_eliminacion =  NULL;
-- php artisan serve --port=8172