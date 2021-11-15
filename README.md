# Sorteos v1.0  - Web Based

Este es un programa creado con las tecnologías de PHP, un poco de JavaScript y MySQL. La aplicación registra usuarios y les permite logear, en caso de que este sea del grupo `admin` se le será otorgado un boton para realizar el sorteo, dandole el nombre del ganador elegido aleatoriamente junto a su cedula (Uruguaya - Verificada por el script de PHP de [Leewayweb](https://github.com/leeway-academy/ci_php))

## Instalación

Descargamos primeramente un software como WAMP o XAMPP, la otra opción es conectarlo a una base de datos en un hosting como Hostinger o similar. Seguidamente debemos editar los archivos `funcSorteo.php` y `server.php` colocando nuestra información de nuestra base de datos en la siguiente linea

```php
$db = mysqli_connect('localhost', 'root', '', 'premios');
```
Cambiando cada parametro como sea necesario en nuestro caso.
```php
Para edición
('localhost', 'usuario', 'contraseña', 'nombredatabase')
```
También deberemos de crear una base de datos, con el nombre que deseemos o dependiente del que tu host te proporcione. La contraseña de nuestro usuario será `1234`

`database.sql`
```sql
-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 15-11-2021 a las 02:40:20
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `premios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pswd` varchar(255) DEFAULT NULL,
  `cedula` varchar(255) DEFAULT NULL,
  `grupos` varchar(255) DEFAULT 'usuario',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `pswd`, `cedula`, `grupos`) VALUES
(1, 'Administrador', 'admin@sorteos.com', '81dc9bdb52d04dc20036dbd8313ed055', '24229181', 'admin'),
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

```
Deberemos de crear nuestra base de datos primeramente en phpMyAdmin con el nombre que le hayamos puesto con anterioridad, con este código SQL clickeamos el boton llamado 'SQL', luego aceptamos y se creará la tabla 'usuarios' en la base de datos.

##
Shadwz17 - Alejo Scheiber\
Leewayweb - Verificación de cedulas Uruguayas

---
NOTA:
Para tener accesso al boton de sortear se debe colocar en grupos 'admin' a la persona en concreto que se le desea otorgar el permiso
---
## License
[MIT](https://choosealicense.com/licenses/mit/)
