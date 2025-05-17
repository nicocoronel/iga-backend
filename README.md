# 📄 IGA Backend

Backend del sistema de gestión de cursos para IGA. Desarrollado con CodeIgniter 4 y documentado con Swagger/OpenAPI.

## 🚀 Tecnologías utilizadas

- PHP 8.1
- CodeIgniter 4
- MySQL
- Composer
- Swagger (zircote/swagger-php)

## 📦 Requisitos

- PHP >= 8.1
- Composer
- MySQL (local o por Docker)
- Opcional: Docker

## 🔧 Instalación y ejecución

Cloná el repositorio y ejecutá los siguientes comandos:

```bash
git clone https://github.com/nicocoronel/iga-backend.git
cd iga-backend
composer install
cp env .env
php spark serve
```

Accedé al backend en: http://localhost:8080

# 🧪 Base de Datos

```bash
database.default.hostname = localhost
database.default.database = iga
database.default.username = root
database.default.password = iga_pass
```

## Migraciones

```bash
php spark migrate
```

# 🐳 Cómo levantar la Base de Datos con Docker

Este proyecto utiliza un contenedor Docker de MySQL para el entorno de base de datos.

## ⚙️ Requisitos

Tener Docker y Docker Compose instalados.

## 🚀 Iniciar la base de datos

Asegurate de tener el archivo docker-compose.yml en la raíz del proyecto.

En la terminal, ejecutá:

```bash
docker-compose up -d
```
Esto iniciará el contenedor de MySQL con la base de datos, usuarios y tablas ya configurados.

## 📦 Puerto MySQL: 3305

## 📁 Volumen: se utiliza un volumen externo que ya contiene los datos de la base.

## 🔐 Credenciales por defecto (según el .env del backend):

Usuario: root

Contraseña: iga_pass

Base de datos: iga

Podés revisar o modificar estos valores en el archivo .env del backend.

## ⏹️ Detener la base de datos

Para detener el contenedor:

```bash
docker-compose down
```

## ⚠️ El volumen de datos no se borra con este comando porque está marcado como externo.

# 📚 Documentación de la API (Swagger)

## Generá la documentación con:

```bash
php spark swagger:generate
```

## Accedé a la documentación en: 

```bash
http://localhost:8080/api/v1/docs/ui
```

# 📁 Estructura de carpetas importante

app/Controllers: controladores del backend

app/Models: modelos conectados a la base de datos

app/Config: configuración general del proyecto

