Swivl
=====

## Installation (Linux system)
- Install git if it need.
- Clone project from GitHub.
  `git clone https://github.com/sevrugin/swivl.git`.
- Enter to the project folder `cd swivl`.
- Run `./composer.phar install` to get project requirements.
- After request in console "Some parameters are missing. Please provide them." just press enter for all questions.
- Exec `sudo docker-compose exec php ./bin/console doctrine:schema:update --force` to create database structure

## How to use
Now you can see API-web interface at http://localhost:8000/_doc

You can use PhpMyAdmin in http://localhost:8080
- server: 
- username: dev
- password: dev
