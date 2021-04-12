# Soap Media Tech Test

## Prerequisites
* PHP 7.4
* Database

## Installation
* Create a file `/.env.local` and add your database DSN, such as ```DATABASE_URL="mysql://root:password@127.0.0.1:3306/db_name?serverVersion=5.7"```
* `$ php -d memory_limit=-1 $(which composer) install`
* `$ php bin/console doctrine:migrations:migrate`

## Setup
Initally no users are set up. This could have been done through a migration, but to avoid having to create reset password 
functionality, it was decided the initial user would need to set this up.

### Setup Admin User
Simply go to the homepage - it will require you to login. Click the Register link at the top of the page to go through the registration process.

The important thing to note here is that by choosing the username `admin`, you automatically get ADMIN access.

### Setup additional users
Repeating the steps from setting up the administrator user will siuffice. Avoiding the username `admin` will ensure that the user has the standard role.

## Usage
### Add Score
Any user who is logged in can add a score. Click the green Add Your Score button at the bottom of the table.

### Filtering
Both Users and Difficulty can be filtered. This works in an AND operation in order to filter across both conditions.

### Ordering
All visible can be order by clicking the relevant link in the header of the table.

### Logout
Clicking the Logout link at the top of the page will log you out. You will redirected back to the login page.

## Administrator Usage
### Deleting Score
Should a score need to be deleted it is possible if you are logged in as the administrator account.
