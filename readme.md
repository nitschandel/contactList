To run this project, LAMP stack should be installed in your system. If not, please

# LAMP Setup

## Step 1: Install Apache

	We can install Apache by typing these commands:
		```bash
		sudo apt-get update
		sudo apt-get install apache2
		```


## Step 2: Install MySQL

	We can install mysql by typing this commands:
		```bash
		sudo apt-get install mysql-server php5-mysql
		```
## Step 3: Install PHP5.6

	We can install php by following commands:
		```bash
		sudo add-apt-repository ppa:ondrej/php5-5.6
		sudo apt-get update
		sudo apt-get install php5
		```
# Composer Setup

	To install it locally:
	```bash
	php composer-setup.php --install-dir=bin --filename=composer
	```
	To install it globally:
	```bash
	mv composer.phar /usr/local/bin/composer
	```

# Project installation

	Clone this repository 

	```bash
	https://github.com/nitschandel/contactList.git
	```

	Install the composer.json by:

	```bash
	composer install
	```

	Install redis:
	```bash
	sudo apt-get install redis-server
	```

	Create a database, and update the name and configuration in .env file.

	## Database migration

	```bash
	php artisan migrate
	```

	## Database seeding

	```bash
	php artisan db:seed
	```

	## Audit Publishing

	```bash
	php artisan auditing:install
	```

	## Publish the configuration file

	```bash
	php artisan vendor:publish
	```

	## To enable Facebook Login

	Create an app in https://developers.facebook.com/ and add its credential in .env file. In Valid OAuth redirect URIs, enter http://localhost:8000/auth/facebook/callback and Website URL as http://localhost:8000/ for local machine.


	## To enable Google Login

	Create an app in https://developers.facebook.com/ and add its credential in .env file. In callback URL, enter http://localhost:8000/auth/google/callback  for local machine.

	## For code analysis, run the following command:

	```bash 
	php artisan sniff
	```

	## For testing, install PHPUnit by the following commands:

	```bash
	composer global require phpunit/phpunit
	```

	And, test the code by:

	```bash
	vendor/bin/phpunit
	```

	##Run the project

	To run the Project, type the following command:

	```bash
	php artisan serve
	```

	ANd your project will be running at http://localhost:8000