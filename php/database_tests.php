<?php

declare(strict_types=1);

$connection = new PDO(
    'mysql:dbname=blog;host=127.0.0.1',
    'root',
    '',
    array(
        PDO::ATTR_EMULATE_PREPARES => FALSE,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    )
);


/* 
Role:
0 - běžný uživatel
1 - admin (němůže měnit nastavení uživatelů)
2 - superadmin (může měnit vše)
*/ 

/*$statement = $connection->prepare('INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)');
$statement->execute([
    'name' => 'reidy',
    'email' => 'reidynoctum@gmail.com',
    'password' => password_hash('123456789', PASSWORD_BCRYPT),
    'role' => 2
]);*/

function createUser(): void{
    global $connection;


    $statement = $connection->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
    $statement->execute([
        'name' => 'noctum',
        'email' => 'noctumpw@gmail.com',
        'password' => password_hash('123456789', PASSWORD_BCRYPT),
    ]);

}

function deleteUser(): void{
    global $connection;

    $statement = $connection->prepare('DELETE FROM users WHERE id=:id');
    $statement->execute(['id' => 23]);
}

function createCategory(string $name, string $slug): void {
    global $connection;

    $statement = $connection->prepare('INSERT INTO categories (name, slug) VALUES (:name, :slug)');
    $statement->execute([
        'name' => $name,
        'slug' => $slug
    ]);
}

createCategory('Návody', 'navody');