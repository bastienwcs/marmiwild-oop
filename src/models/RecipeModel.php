<?php

class RecipeModel
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = new PDO('mysql:host=' . SERVER . ';dbname=' . DATABASE . ';charset=UTF8', USER, PASSWORD);
    }

    public function getAll(): array
    {
        $statement = $this->connection->query('SELECT * FROM recipe');
        $recipes = $statement->fetchAll();

        return $recipes;
    }

    public function getById(int $id): array
    {
        $statement = $this->connection->prepare('SELECT * FROM recipe WHERE id = :id');
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $recipe = $statement->fetch();

        return $recipe;
    }

    public function save(array $recipe): void
    {
        $statement = $this->connection->prepare('INSERT INTO recipe (title, description) VALUES (:title_value, :description_value)');
        $statement->bindValue(':title_value', $recipe['title'], PDO::PARAM_STR);
        $statement->bindValue(':description_value', $recipe['description'], PDO::PARAM_STR);
        $statement->execute();
    }

    public function delete(int $id): bool
    {
        $statement = $this->connection->prepare('DELETE FROM recipe WHERE id = :id');
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $count = $statement->rowCount();

        return $count > 0;
    }
}
