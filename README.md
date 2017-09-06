Docker LAMP
===========

Linux/Apache/MySQL/PHP development environment

### Features

-	PHP 5.6 (CLI & Apache 2.0 Handler)
-	ionCube PHP Loader
-	Zend OPcache
-	Xdebug
-	Composer
-	MySQL
-	phpMyAdmin

### Web access

http://localhost:8080/

### phpMyAdmin access

http://localhost:8282/

### MySQL access

```
Host internal: db
Port internal: 3306

Host external/remote: localhost
Port external/remote: 8181

User: user
Password: password
Database: database

Root Password: root
```

Build
-----

```
docker-compose build
```

Run
---

```
docker-compose up
```

or

```
docker-compose up -d
```

> Param `-d` runs container in background (detach)

Bash into
---------

```
docker exec -ti dockerlampphp56_php_1 /bin/bash
```

> Container name is `dockerlampphp56_php_1`. Change it to your container name.

Stop
----

```
docker-compose down
```

> To stop all containers and kill all volumes `docker-compose down --volumes`. Data (mysql databases, ...) will be lost!
