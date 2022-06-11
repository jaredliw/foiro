cd %~dp0
start "foiro - frontend" cd frontend ^&^& npm run serve
start "foiro - backend" cd backend ^&^& php -S 127.0.0.1:8081 app.php
start "mysql server" mysqld --console
