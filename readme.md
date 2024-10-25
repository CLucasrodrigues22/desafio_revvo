
<h1 align='center'>
  Welcome to Revvo Desafio Instructions
</h1>

<p align='center'>
  Project developed as part of the selection process for the position of Fullstack Developer,
with a focus on showing knowledge of the required technologies.
</p>

<div align="center">

![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![JavaScript](https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E)
![MySQL](https://img.shields.io/badge/mysql-4479A1.svg?style=for-the-badge&logo=mysql&logoColor=white)
![Docker](https://img.shields.io/badge/docker-%230db7ed.svg?style=for-the-badge&logo=docker&logoColor=white)

</div>

### Requirements

#### To run challengerAPI on your machine, it must meet the following requirements:


- [PHP 8.3](https://www.php.net/downloads)
- [Composer 2.7](https://getcomposer.org/download/)
- [Docker](https://www.docker.com/)

### How to install

- First, clone this repository on your machine:

```
git clone https://github.com/CLucasrodrigues22/desafio_revvo
```

- Open a new terminal window at the root of the project and create an .env based on the .env.example:

```
cp .env.example .env
```

- Copy and paste the following environment variables into the .env of your environment:

```
DB_PASSWORD=(your_password)
```

- Configure the containers, use the command:

```
docker-compose up -d
```

- Access the db container:

```
docker exec -it dbserver sh
```

- Access the mysql service:

```
mysql -u root -p 
```

- Execute the instructions in path:

```
./database/init.sql
```

