<h1 align="center">Contact Book
<img src="https://img.icons8.com/?size=100&id=12369&format=png&color=000000" alt="" width="50" height="50" align="center">
</h1>


<br><br>
# Overview

<p style="text-align: justify">
A simple PHP & MySQL web application that allows users to register, log in, and manage their personal contacts.
</p>

### Features:
- ✅ User authentication (Registration/Login)
- ✅ Add, delete, edit and view contacts
- ✅ MySQL database with foreign key relations
- ✅ Session management for logged-in users


### Installation:
1. Clone this repository.
```
git clone https://github.com/JeyJayF1/discord-bot.git
```
2. Navigate to the project folder
```
cd 'folder-name'
```
3. Set up the MySQL database: (Create a contact_book database in phpmyadmin.)
<div>

a. User Table <br>
```sql
CREATE TABLE `contact_book`.`users`
(`id` INT NOT NULL AUTO_INCREMENT ,
`user` VARCHAR(25) NOT NULL ,
`password` CHAR(255) NOT NULL ,
`reg_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
PRIMARY KEY (`id`), INDEX (`user`)) ENGINE = InnoDB;
```

b. Contact Table <br>
```sql
CREATE TABLE `contact_book`.`contacts`
(`id` INT NOT NULL AUTO_INCREMENT ,
`user_id` INT(255) NOT NULL ,
`name` VARCHAR(255) NOT NULL ,
`phone` VARCHAR(20) NOT NULL ,
`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
PRIMARY KEY (`id`), INDEX (`user_id`)) ENGINE = InnoDB;
```

c. Foreign Key Constraint
```sql
ALTER TABLE `contacts` ADD CONSTRAINT
`user-contacts` FOREIGN KEY (`user_id`)
REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;
```
</div>

4. Start a local server (XAMPP, WAMP, etc...)
```
php -S localhost:8000
```
