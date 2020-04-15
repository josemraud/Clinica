CREATE SCHEMA `Proyecto_Final` ;
CREATE USER 'userProyecto'@'%' IDENTIFIED BY 'P@ssw0rd';
GRANT ALL ON Proyecto_Final.* TO 'userProyecto'@'%';
