<p align="center"><img src="https://media1.giphy.com/media/v1.Y2lkPTc5MGI3NjExNmJmZGh0aHRodWs2eXI1ZmgzazF6b2xtbGoyc2x6YzB1NTloNW55eiZlcD12MV9naWZzX3NlYXJjaCZjdD1n/YJBNjrvG5Ctmo/200.webp" width="200" alt="Laravel Logo"></p>



## Giphy Bookmarks Challege

El desafío es integrarse a una API existente y desarrollar una API REST propia que exponga un conjunto de servicios. Asimismo se
deberán entregar distintos diagramas que representen la solución.

Para la atentiacion de OAuth2.0 se utilizo la libreria [Laravel Passport](https://laravel.com/docs/11.x/passport).



## Requisitos

- PHP 8.2+
- Laravel 10.x+
- MySQL/MariaDB/TiDB
- Composer


## Como ejecutar el proyecto con docker

Este proyecto cuenta con la herramienta de sail que nos pemitira ejecutar el proyecto en con doker. Para ello debemos ejecutar los siguientes comandos:

1 -  clonar el repositorio

```bash
git clone https://github.com/andres-torres/giphy-bookmarks.git 
```

2 - entrar al directorio del proyecto

```bash
cd giphy-bookmarks 
```
3 - Instalacion de dependencias PHP

```bash
    composer install
```


3 - Para lanzar el proyecto en docker debemos ejecutar los siguientes comandos:

```bash
./vendor/bin/sail up -d
```

4 - Corremos los migrates de bases de datos

```bash
./vendor/bin/sail artisan migrate
```

### Diagrama de Casos de Uso

```mermaid
graph TD
    User((Usuario))
    
    Register[Registrarse con OAuth]
    Login[Iniciar sesión]
    SearchGIFs[Buscar GIFs]
    SearchGIFbyID[Buscar GIF por ID]
    SaveFavorite[Guardar GIF favorito]
    
    User --> Register
    User --> Login
    User --> SearchGIFs
    User --> SearchGIFbyID
    User --> SaveFavorite
    
    subgraph "Sistema API REST"
    Register
    Login
    SearchGIFs
    SearchGIFbyID
    SaveFavorite
    end
    
    GIPHY[[API de GIPHY]]
    OAuth[[Proveedor OAuth]]
    
    Register --> OAuth
    Login --> OAuth
    SearchGIFs --> GIPHY
    SearchGIFbyID --> GIPHY
```
