# Rest Api built with Lumen

![tables](./tables.pdf)

You are able to

- Get the list of all clients
- Get one specific client
- Get all contracts specific to one client
- Update a contract

# Environment Setup

I used a boiler plate to create the environment for the project. Docker + Lumen with Nginx and MySQL.

# Routes

# How to use

Copy the project

```bash
git clone https://github.com/lalsdev/restAPI-lumen
```

Build the project

```bash
sudo docker-compose up --build
```

Enter the project

```bash
cd lumen
```

Make migrations (you enter into the docker container and so you are able to make migrations)

```bash
docker-compose exec php sh
```
