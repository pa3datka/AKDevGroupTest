## Description

Test task AKDevGroupTest.

## Installation
1. git clone git@github.com:pa3datka/AKDevGroupTest.git
2. cd ./AKDevGroupTest

### create .env
3. cp .env.example .env
4. cp ./src/.env.example ./src/.env

### build docker
5. docker-compose build app
6. docker-compose up -d

### composer install

7. docker-compose exec app composer install
8. docker-compose exec app php artisan key:generate
9. docker-compose exec app php artisan migrate

goto utl http://127.0.0.1:8000

Backend test task:


Create a framework based (eg Laravel) REST API for to-do app.
Features and Requirements:
- Use composer to initiate your project.
- Use Github to store you code. Include Readme.md file with instructions how to run your app.
- Use Any environment managment you prefer (docker, vagrant, etc)
- Your app should contain easy login/register functionality with email/password.
- After login user is able to create/edit/view/list/remove (CRUDL) to-do lists on his account
- User is able to add/edit/view/remove (CRUDLS) todos in the list
- User cannot access todos/todo lists of other users.



Bonuses (use any dependencies you need):
- Include some unit/feature tests
- Add ability to share lists with other users (eg. family todos/family grocery list)
- Add ability to export list as PDF via background job
- Add ability to upload files/images for todos

