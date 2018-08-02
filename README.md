# codeigniterjwtapi
1. Install JWT using composer "composer require firebase/php-jwt"
2. Create database, create user table (id, username, password), create product table (id, name, description, image). and insert some dummy data to the table
3. Open application\config\database.php and set your database user, password, and chose the database name you have create in step two
4. Im using postman to test, type the url ex: localhost/codeigniterjwtapi/index.php/rest/login
	add header 'Accept' value 'Application/json',
	method 'POST',
	Body form body 'username' value 'dumy username in user table',
	Body form body 'passowrd' value 'dumy password in user table',
	if success it will return token, token is need to access the product data
5. access all product data in localhost/codeigniterjwtapi/index.php/api/product
	add header 'Accept' value 'Application/json',
	add header 'Authorization' value 'token generated after login success',
	method 'GET'
6. access specific product data in localhost/codeigniterjwtapi/index.php/api/product/{id product}
	add header 'Accept' value 'Application/json',
	add header 'Authorization' value 'token generated after login success',
	method 'GET'
7. create product data in localhost/codeigniterjwtapi/index.php/api/product
	add header 'Accept' value 'Application/json',
	add header 'Authorization' value 'token generated after login success',
	method 'POST',
	add Body x-www-form-urlencoded,
	'name' value 'product name',
	'description' value 'product description',
	'price' value 'product price',
	'image' value 'product image'
8. update product data in localhost/codeigniterjwtapi/index.php/api/product/{id product}
	add header 'Accept' value 'Application/json',
	add header 'Authorization' value 'token generated after login success',
	method 'PUT',
	add Body x-www-form-urlencoded,
	'name' value 'product name',
	'description' value 'product description',
	'price' value 'product price',
	'image' value 'product image'
9. delete product data in localhost/codeigniterjwtapi/index.php/api/product/{id product}
	add header 'Accept' value 'Application/json',
	add header 'Authorization' value 'token generated after login success',
	method 'DELETE'


this project using https://github.com/chriskacerguis/codeigniter-restserver
and php-jwt