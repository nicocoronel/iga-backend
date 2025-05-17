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

# Migraciones

```bash
php spark migrate
```

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

