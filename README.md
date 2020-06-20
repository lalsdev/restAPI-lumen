# Rest Api built with Lumen

![tables](tables.jpeg)

You are able to

- Get the list of all clients
- Get one specific client
- Get all contracts specific to one client
- Update a contract

## Environment Setup

I used a boiler plate to create the environment for the project. Docker + Lumen with Nginx and MySQL.

## Routes

## How to use

Copy the project

```bash
git clone https://github.com/lalsdev/restAPI-lumen
```

Go in folder

```bash
cd restAPI-lumen
```

Build project

```bash
sudo docker-compose up --build -d
```

Enter the container

```bash
sudo docker-compose exec php sh
```

Exit current folder inside the container

```bash
cd ..
```

Download modules from composer

```bash
composer install
```

You should be able to access the routes

Stop container

```bash
sudo docker-compose down
```

### Create client

POST http://localhost:80/api/v1/clients

### Update one or more attributes from client

PUT http://localhost:80/api/v1/clients

### Delete

DELETE http://localhost:80/api/v1/clients/{client_id}

### Get all clients

GET http://localhost:80/api/v1/clients

### Get one specific client

GET http://localhost:80/api/v1/clients/{client_id}

### Create contract

POST http://localhost:80/api/v1/clients/{client_id}/contrats

### Update one or more attributes from contract

PUT http://localhost:80/api/v1/clients{client_id}/contrats/{contrat_id}

### Delete

DELETE http://localhost:80/api/v1/clients/{client_id}/contrats/{contrat_id}

### Get all contracts

GET http://localhost:80/api/v1/contrats

### Get one contract

GET http://localhost:80/api/v1/contrats/{contrat_id}

### Get all contracts from one client

GET http://localhost:80/api/v1/clients/{client_id}/contrats

### Get one contract from one client

GET http://localhost:80/api/v1/clients/{client_id}/contrats/{contrat_id}
