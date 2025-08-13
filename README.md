![alt text](https://media-public.canva.com/CrTLQ/MAE_7sCrTLQ/1/t.png "Title")
# Sobap

Sobap is a lightweight yet powerful PHP framework designed for modern web application development. With a focus on simplicity, modularity, and extensibility, Sobap delivers essential tools for building robust and maintainable applications—without unnecessary overhead. Whether you're creating APIs or dynamic websites, Sobap empowers you to move fast with clear structure and efficient code.

---
> **Note:** Sobap is built using only PHP core. No Composer, package managers, or autoloading are used. All dependencies are managed and loaded manually within the source code.

## Features
- **Routing System**
  - Register routes for GET and POST requests using expressive syntax.
  - Supports custom controller handlers and closures.

- **Request Handling**
  - Unified `Request` object for accessing GET, POST, COOKIE data and custom parameters.

- **Authentication**
  - JWT-based authentication implementation.
  - Secure login, logout, and session management.
  - Blacklist support for invalidated tokens.

- **Validation**
  - Extensible validation mechanism for input data.
  - Custom validators can be implemented and invoked.

- **Database Operations**
  - Fluent API for SELECT, INSERT, UPDATE, DELETE queries.
  - Support for transactions, joins, distinct queries, and raw SQL execution.
  - Easily extensible: you can add new database functionalities by simply creating new files for custom logic and chaining them with existing database modules.
  - This flexible architecture allows developers to integrate specific features and extend database operations without modifying the core.
- **Response Object**  
  - Return JSON data
  - Perform redirects
  - You can add new your own functionalities
- **View Rendering**
    - Using native DOM PHP extension for view rendering.
    - Views and handlers are split and communicate via the DOM
- **Utility**
  - Provides utility functions and libraries.
  - Developers can easily write their own utility functions and use them anywhere in the project for maximum flexibility.
- **Exception and Error Handling**
  - Centralized error and exception handling with debug mode and HTML trace output.

- **Security**
  - Content-Security-Policy and CORS header management functions.
  - CSRF token generation and session management.

- **Testing**
  - PHPUnit tests for routing, authentication, and view output to ensure reliability.
  - Static analysis with [PHPStan](https://github.com/phpstan/phpstan) helps maintain high code quality and catch bugs early.
- **Built-in Environment Configuration**
  - Easily manage environment variables and configuration directly within the framework, without external `.env` libraries.
  - Flexible environment management is supported. This allows dynamic configuration and runtime changes to environment values.


---
## Requirements

- **PHP**: >= 8.4  
  Sobap leverages the latest PHP features, so a recent version is required.

- **Web Server**: Must support `.htaccess` (such as Apache, or compatible stacks like MAMP, Laragon, XAMPP, etc.)  
  For clean URL routing and request handling, ensure your web server is configured to use `.htaccess`.

- **MySQL**: >= 8.0.30 (optional, only required if you use the database features)  
  If your application requires database interaction, Sobap supports MySQL 8.0.30 or later.

---
## Getting Started

### Installation

```bash
git clone https://github.com/TunKitter/sobap.git
```

---

## Example Usage

### 1. Routing

```php
// Register routing with function
Route::get('/submit', function($request) {
    // write your code here...
});

// Register routing with controller
Route::post('/home', 'HomeController::index');

// Register routing with sub-folder controller 
Route::post('/home', 'Blog/Detail/DetailController::index');
```

### 2. Controller Example

```php
class HomeController {
    public function index(Request $request) {
        $view = View::getView('views/home', ['methods/layout', 'methods/home']);
        $view->home->setName(enco_html("Welcome!", true));
        $view->layout->render();
    }
}
```

### 3. Request Access

```php
class HomeController {
    public function index(Request $request) {
        $request->get('name');
        $request->get('name','default value');
        $request->post('value');
        $request->cookie('Auth');
    }
}
```

### 4. Authentication (JWT)

```php
// Login
$status = Auth::use('jwt')->login($request);

// Check authentication
$status = Auth::use('jwt')->check($request);

// Logout
Auth::use('jwt')->logout($request);
```

### 5. Validation

```php
// Example validate
Validate::from('something text')->alphaNumericSpace()->regex('/{\w+}+/','please try again')->validate();

// Custom validator
Validate::with('myOwnValidate')->from('demo1')->justDemo()->validate();
```

### 6. Database Operations

```php
// Insert
Database::insert('something')->columns('name', 'age')->withData(['Alice', 22])->execute();

// Select
Database::select('something')->where('id', '>', 10)->get();

// Update
Database::update('something')->set(['name' => 'Bob'])->where('id', '=', 1)->execute();

// Transaction
Database::transaction(function ($db, $commit, $rollback) {
    $db::insert('something')->columns('name', 'age')->withData(['Test', 18])->execute();
    $commit();
});
```

### 7. View Rendering

```php
$dom = new DOMDocument();
$dom->loadHTML('<h1>Hello, World!</h1>');
$view = new DOMDecorator($dom);
$view->render();
```

## Contributing

Contributions are welcome! Please submit pull requests for new features, bug fixes, or improvements. For major changes, please open an issue first to discuss what you would like to change.

---

## License

This project is open-sourced under the [MIT license](LICENSE).

---