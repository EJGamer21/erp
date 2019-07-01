-- Create a new table called 'usuarios' in schema 'fractal'
-- Create the table in the specified schema
CREATE TABLE fractal.usuarios
(
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY, -- primary key column
    codigo VARCHAR(15) NOT NULL UNIQUE,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    sexo ENUM('M','F') NOT NULL,
    direccion_id INT,
    username VARCHAR(50) UNIQUE,
    clave VARCHAR(255),
    email_id INT,
    fecha_creacion DATETIME,
    fecha_modificado DATETIME,
    activo BOOLEAN DEFAULT 1 NOT NULL
    -- specify more columns here
) ENGINE=INNODB;
-- Create a new table called 'emails' in schema 'fractal'
CREATE TABLE fractal.emails
(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email varchar(100) NOT NULL
) ENGINE=INNODB;

-- Create a new table called 'direcciones' in schema 'fractal'
-- Create the table in the specified schema
CREATE TABLE fractal.direcciones
(
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    provincia_id INT,
    ciudad_id INT,
    sector_id INT
) ENGINE=INNODB;

CREATE TABLE provincias
(
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nombre varchar(100) NOT NULL
) ENGINE=INNODB;

CREATE TABLE ciudades
(
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nombre varchar(100) NOT NULL
) ENGINE=INNODB;

CREATE TABLE sectores
(
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nombre varchar(100) NOT NULL
) ENGINE=INNODB;

ALTER TABLE fractal.usuarios
    ADD FOREIGN KEY fk_direccion_id(direccion_id)
    REFERENCES direcciones(id)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
    
    ADD FOREIGN KEY fk_email_id(email_id)
    REFERENCES emails(id)
    ON DELETE SET NULL
    ON UPDATE CASCADE
;

ALTER TABLE fractal.direcciones
    ADD FOREIGN KEY fk_provincia_id(provincia_id)
    REFERENCES provincias(id)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
    
    ADD FOREIGN KEY fk_ciudad_id(ciudad_id)
    REFERENCES ciudades(id)
    ON DELETE SET NULL
    ON UPDATE CASCADE,

    ADD FOREIGN KEY fk_sector_id(sector_id)
    REFERENCES sectores(id)
    ON DELETE SET NULL
    ON UPDATE CASCADE
;

-- Create a new table called 'usuarios_direcciones' in schema 'fractal'
-- Create the table in the specified schema
CREATE TABLE fractal.usuarios_direcciones
(
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    usuario_id INT,
    direccion_id INT
) ENGINE=INNODB;

ALTER TABLE fractal.usuarios_direcciones
    ADD FOREIGN KEY fk_usuario_id(usuario_id)
    REFERENCES usuarios(id)
    ON DELETE SET NULL
    ON UPDATE CASCADE,

    ADD FOREIGN KEY fk_direccion_id(direccion_id)
    REFERENCES direcciones(id)
    ON DELETE SET NULL
    ON UPDATE CASCADE
;

-- Create a new table called 'clientes' in schema 'fractal'
-- Create the table in the specified schema
CREATE TABLE clientes
(
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nombre varchar(150) NOT NULL,
    dni varchar(20) NOT NULL UNIQUE,
    telefono INT NOT NULL UNIQUE,
    cantidad_compras INT
) ENGINE=INNODB;

CREATE TABLE configuracion
(
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    valor VARCHAR(100) DEFAULT ""
) ENGINE=INNODB;

CREATE TABLE productos
(
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    codigo INT NOT NULL UNIQUE,
    nombre VARCHAR(250) NOT NULL,
    precio FLOAT(11, 2) NOT NULL DEFAULT 0.00,
    existencia INT,
    impuesto FLOAT(11, 2) NOT NULL,
    precio_total FLOAT(11, 2) NOT NULL
) ENGINE=INNODB;

CREATE TABLE facturas
(
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    codigo VARCHAR(20) UNIQUE,
    vendedor_id INT,
    comprador_id INT,
    fecha_creacion DATETIME,
    fecha_modificacion DATETIME,
    modificado_por INT,
    precio_total FLOAT(11, 2),

    FOREIGN KEY fk_vendedor_id(vendedor_id)
    REFERENCES usuarios(id)
    ON UPDATE CASCADE
    ON DELETE NO ACTION,

    FOREIGN KEY fk_comprador_id(comprador_id)
    REFERENCES clientes(id)
    ON UPDATE CASCADE
    ON DELETE NO ACTION,

    FOREIGN KEY fk_modificado_por(modificado_por)
    REFERENCES usuarios(id)
    ON UPDATE CASCADE
    ON DELETE NO ACTION
) ENGINE=INNODB;

CREATE TABLE detalles_factura
(
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    producto_id INT,
    cantidad INT,
    precio FLOAT(11,2),
    factura_id INT,

    FOREIGN KEY fk_factura_id(factura_id)
    REFERENCES facturas(id)
    ON UPDATE CASCADE
    ON DELETE NO ACTION
);