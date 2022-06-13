## About Easysubscribe

A newsletter subscription application where users can subscribe to a website to receive updates (email) on new posts.


## Requireents

1. PHP ^7.3 || 8.0.
2. Composer ^2.0
3. And off course the knowledge of servers.

## Installation

1. clone this repository. run: git clone https://github.com/perepaul/easysubscribe.git on your terminal
2. run: **cd easysubscribe** // on your terminal
3. run: **composer install** // on your terminal to install the dependencies.
4. run: **cp .env.example .env** // on your terminal
5. run: **php artisan key:generate**
6. set your database credentials in the env file. ie. database host, port, user and password.
7. run: **php artisan migrate** on your terminal to generate the database tables.

## Endpoints

The application consist of endpoints and each carry out a specific task. Set the http Accept header to 'application/json'.

### Users Endpoints

- **GET -** /api/users : Gets a paginated list of users
- **POST -** /api/users : Creates a new user 

    ```
    body:{ 

        name,  

        email, 

        password, 

        password_confirmation 

    }
    ```

- **GET -** /api/users/{user} : Gets a single user
- **PUT -** /api/users/{user} : Updates a user 

    ```
    body:{ 

        name,  

        email,  

        password,  

        password_confirmation 

    }
    ```

- **DELETE -** /api/users/{user} : Soft deletes a user and its related record.
- **POST -** /api/users/{user}/subscribe : Subscribes a user to a website

    ```
    body:{ 

        websites 

    }
    ```

- **POST -** /api/users/{user}/unsubscribe : Unsubscribes a user from a website 

    ```
    body:{ 

        websites 

    }
    ```

### Websites Endpoints

- **GET -** /api/websites : Gets a paginated list of websites

    ```
    body:{ 

        name,  

        url,
    }
    ```

- **POST -** /api/websites : Creates a new website
- **GET -** /api/websites/{website} : Gets a single website
- **PUT -** /api/websites/{website} : Updates a website

    ```
    body:{ 

        name,  

        url, 

    }
    ```

- **DELETE -** /api/websites/{website} : Soft deletes a website and its related posts.

### Posts Endpoints

- **GET -** /api/posts : Gets a paginated list of posts
- **POST -** /api/posts : Creates a new post

    ```
    body:{ 

        website_id, 

        title, 

        body, 

    }
    ```

- **GET -** /api/posts/{post} : Gets a single post
- **PUT -** /api/posts/{post} : Updates a post

    ```
    body:{ 

        title, 

        body, 
    }
    ```

- **DELETE -** /api/posts/{post} : Soft deletes a post.


## HTTP Response Structure

    ```
    {
        message:'',
        data: {},
        errors: {},
    }
    ```

## Credits

If you like what you see, please send an e-mail to Paulinus Perekpo Emmanuel via [perekpopaulinus@gmail.com](mailto:perekpopaulinus@gmail.com).

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
