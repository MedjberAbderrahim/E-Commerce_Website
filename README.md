# El-Wawi Store - E-commerce Website

A simple e-commerce website built with pure PHP, JavaScript, and MySQL. Features user authentication, product management, shopping cart functionality, and admin controls.

## Features

- User authentication (login/register)
- Product browsing and search
- Shopping cart system
- Admin panel for product management
- Responsive design
- Secure against SQL injection and XSS attacks

## Prerequisites

- PHP5, Apache web server and MySQL (generally provided by XAMPP by default)
- XAMPP (recommended) or similar local development environment, Built the project with XAMPP 8.2.12-0

## Installation

1. Clone the repository
```bash
git clone https://github.com/MedjberAbderrahim/E-Commerce_Website.git
```

2. Import database structure
- Start XAMPP and ensure MySQL is running
- Create a new database named `MainDB`
- Import `init.sql` into your database

3. Configure database connection
- Open `functions/Connect_DB.php`
- Update database credentials if needed:
```php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "MainDB";
$port = 3306;
```

4. Set up the project
- Move the project to your XAMPP's `htdocs` directory
- Ensure the `uploads` directory has write permissions

## Usage

1. Start XAMPP (Apache and MySQL)
2. Access the website: `http://localhost/E-Commerce_Website/`
3. Default admin credentials:
    - Username: `admin`
    - Password: `admin`

## Admin Features

- Add new products with images
- Delete existing products
- View all user transactions

## Security Features

- Password hashing using bcrypt
- Prepared SQL statements (Protection against SQL Injections)
- XSS protection
- Session management
- Input validation

## Directory Structure

```
.
├── assets/
│   ├── images/
│   ├── scripts/
│   └── styles/
├── functions/
├── uploads/
├── index.php
├── login.php
├── product.php
└── init.sql
```

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License

[MIT](https://choosealicense.com/licenses/mit/)