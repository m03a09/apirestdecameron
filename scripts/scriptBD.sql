-- Crear la base de datos
CREATE DATABASE decameronbd;

-- Tabla de ciudades
CREATE TABLE ciudades (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    created_at TIMESTAMP WITHOUT TIME ZONE,
    updated_at TIMESTAMP WITHOUT TIME ZONE
);

-- Tabla de hoteles
CREATE TABLE hoteles (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    nit VARCHAR(20) NOT NULL,
    ciudad_id INT NOT NULL,
    numero_habitaciones INT NOT NULL,
    created_at TIMESTAMP WITHOUT TIME ZONE,
    updated_at TIMESTAMP WITHOUT TIME ZONE,
    CONSTRAINT unique_nombre_nit UNIQUE (nombre, nit),
    CONSTRAINT fk_ciudad FOREIGN KEY (ciudad_id) REFERENCES ciudades(id)
);

-- Tabla de tipos de habitación
CREATE TABLE tipos_habitacion (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    created_at TIMESTAMP WITHOUT TIME ZONE,
    updated_at TIMESTAMP WITHOUT TIME ZONE
);

-- Tabla de tipos de acomodación
CREATE TABLE acomodaciones (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    created_at TIMESTAMP WITHOUT TIME ZONE,
    updated_at TIMESTAMP WITHOUT TIME ZONE
);

-- Tabla de habitaciones por hotel
CREATE TABLE habitaciones (
    id SERIAL PRIMARY KEY,
    hotel_id INT NOT NULL,
    tipo_habitacion_id INT NOT NULL,
    acomodacion_id INT NOT NULL,
    cantidad INT NOT NULL,
    created_at TIMESTAMP WITHOUT TIME ZONE,
    updated_at TIMESTAMP WITHOUT TIME ZONE,
    CONSTRAINT fk_hotel FOREIGN KEY (hotel_id) REFERENCES hoteles(id) ON DELETE CASCADE,
    CONSTRAINT fk_tipo_habitacion FOREIGN KEY (tipo_habitacion_id) REFERENCES tipos_habitacion(id),
    CONSTRAINT fk_acomodacion FOREIGN KEY (acomodacion_id) REFERENCES acomodaciones(id),
    CONSTRAINT unique_hotel_tipo_acomodacion UNIQUE (hotel_id, tipo_habitacion_id, acomodacion_id)
);