# Blog Admin and User Panel 
Blog Admin and User Panel using Laravel Framework. Creating Blog Admin using Admin LTE panel and Blog User side using Blog bootstrap template

### Features:
### Blog – Admin Panel:
1.	Multi Login System.
2.  Role Based Access Level Login 
	- Author Role
  - Editor Role
  - Publisher Role
3.  Post according to user only.
4.  CRUD 
	- Blog Post - List/Show/Add/Edit/Delete posts.
  - Category - List/Show/Add/Edit/Delete categories.
  - Tag  - List/Show/Add/Edit/Delete tags.
5.	Dashboard to show how many users are there and how many blogs are created using particular user.
6.	Image CRUD - List/Show/Add/Edit/Delete images
7.	CK-Editor for fast writing
8.  User login and logout history system.
9.	Pagination feature is available on Products list.

### Blog – User Panel:
1.	Create every post on page.
2.  Category and tag lists. 
3.  Facebook comment section.
4.  Provide archives, Tag clouds .
5.	Searching blog.
6.	Social sharing like Twitter post & facebook

MYSQL dump of the database named blog.sql’ is provided.  

### Prerequisites

•	XAMPP (start MySQL, Apache service)
•	Phpmyadmin 
•	Php laravel (Laravel Framework 5.4, PHP version 7.2)
•	Text editor (Visual Studio Code)

## Getting Started

Step 1: Download and add the folder inside ‘C:\xampp\htdocs’

Step 2: Open phpmyadmin http://localhost/phpmyadmin/index.php , create database ‘blog’ and import database dump file ‘blog.sql’ into it.

Step 3: Go to command prompt

c:\xampp\htdocs\blog>php artisan serve 
Visit http://127.0.0.1:8000/ to see the application in action.

Note: If you cannot see images (attachments) on webpage , then remove folder ‘storage’ from ‘app\public’ and then again link it using command as follows: ‘php artisan storage:link’

### Blog Home page with all the posts
![blog home page with all the posts](https://user-images.githubusercontent.com/14937374/38236493-96c3871a-3724-11e8-8473-fcdd21e537b7.png)




### Blog User Login
![blog user login](https://user-images.githubusercontent.com/14937374/38236506-a6704108-3724-11e8-9f25-7f8e162e45f7.png)





### User's home page after User Login
![user s home page after user login](https://user-images.githubusercontent.com/14937374/38236516-b256b9de-3724-11e8-972f-89304ed522d0.png)






### Blog Admin Login
![blog admin login](https://user-images.githubusercontent.com/14937374/38236522-bc86f4b4-3724-11e8-82c4-20e6fc082c40.png)







### Admin's home page after Admin Login
![admin s home page after admin login](https://user-images.githubusercontent.com/14937374/38236536-c6057768-3724-11e8-86d8-bf876a8e4c5e.png)






