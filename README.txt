Personal note:
	I created the project in Windows Subsystem for Linux (WSL), a Linux Environment for Windows user.
	Linux environment should have golang, php, composer and mysql-server installed. (See instruction below under Setting up Linux system)
	My IDE is Visual Studio Code integrated with necessary extensions align with Windows Subsystem for Linux (WSL)
	When I open a terminal, I run first: wsl --install -d Ubuntu

Go and Laravel Project Setup Instructions
Prerequisites
Before you begin, ensure you have the following installed on your Linux system:

	PHP 8.3.6 or higher
	Composer
	MySQL 
	Git
	Go (Golang) 1.20 or higher

Setting up your Linux system: 	
	sudo apt-get update	
	sudo apt install golang-go php composer mysql-server curl git php-curl php-mbstring php-xml	
	wget https://golang.org/dl/go1.20.3.linux-amd64.tar.gz
	sudo tar -C /usr/local -xzf go1.20.3.linux-amd64.tar.gz
	echo 'export PATH=$PATH:/usr/local/go/bin' >> ~/.profile
	source ~/.profile
	
Setting up database: 
	sudo mysql		
	CREATE USER 'rashnu'@'localhost' IDENTIFIED BY 'rashnuroot';
	GRANT ALL PRIVILEGES ON *.* TO 'rashnu'@'localhost';
	FLUSH PRIVILEGES;	
	CREATE DATABASE ticket_sales;
	
Clone the Repository:
	git clone https://github.com/enrikespiritu/laravel-golang-project.git
	
Setting Up the Golang Project:
	cd ~/laravel-golang-project/backend
	go mod tidy
	go run main.go
	
Setting Up the Laravel Project:
	cd ~/laravel-golang-project/frontend
	composer install
	cp .env.example .env
	php artisan serve
	
Open a browser and go to: http://127.0.0.1:8000