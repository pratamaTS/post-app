How to run this project

1. Clone this project
2. Run composer install on terminal (in the project folder or just use vscode terminal)
2. Create post Database
3. Set env to post (the value is on the env example, just change the name into .env)
4. Run php artisan migrate 
5. Set virtual host on xampp / just run php artisan serve and voalaa! this apps is running
6. Set your local url to this project, to call api in postman or anything else, use url like this : http://your-local-url/api/posts -> look in the api.php
7. Run php artisan test to run unit test
8. Enjoy!

The api url:
1. Get Posts: GET http://your-local-url/api/posts
2. Show Post:  GET http://your-local-url/api/posts/{id}
3. Create Post: POST http://your-local-url/api/posts
4. Update Post: PUT http://your-local-url/api/posts/{id}
5. Delete Post: DELETE http://your-local-url/api/posts/{id}