<?php

require_once 'vendor/autoload.php';
require_once 'app/core/bootstrap.php';

use App\Core\App;
use App\Core\Database\QueryBuilder;

function createMigrationsTable(QueryBuilder $q)
{
    // Create migrations table if it doesn't exist
    $q->prepare('CREATE TABLE IF NOT EXISTS migrations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        migration VARCHAR(255) NOT NULL,
        batch INT NOT NULL
    )')->execute();
}
function migrate(QueryBuilder $q)
{

    $files = scandir(__DIR__.'/database/migrations');
    $files = array_diff($files, ['.', '..']);

    foreach ($files as $file) {
        try {
            require_once __DIR__."/database/migrations/$file";

            $migrationName = basename($file, '.php');

            $stmt = $q->prepare('SELECT * FROM migrations WHERE migration = ?');
            $stmt->execute([$migrationName]);
            $existingMigration = $stmt->fetch();

            if ($existingMigration === false) {
                up($q);
                $batch = max(0, $q->query('SELECT MAX(batch) FROM migrations')->fetchColumn()) + 1;
                $q->prepare('INSERT INTO migrations (migration, batch) VALUES (?, ?)')->execute([$migrationName, $batch]);
            }
        } catch (PDOException $e) {
            echo "Migration failed: " . $e->getMessage();
        }
    }
}

function rollback(PDO $q)
{
    $batch = $q->query('SELECT MAX(batch) FROM migrations')->fetchColumn();
    if ($batch !== false) {
        $stmt = $q->prepare('SELECT migration FROM migrations WHERE batch = ?');
        $stmt->execute([$batch]);
        while ($row = $stmt->fetch()) {
            try {
                require_once __DIR__."/database/migrations/{$row['migration']}.php";
                down($q);
                $q->prepare('DELETE FROM migrations WHERE batch = ?')->execute([$batch]);
            } catch (PDOException $e) {
                echo "Rollback failed: " . $e->getMessage();
            }
        }
    }
}
try {
    $q = App::get('database');
    $q->prepare('SELECT * FROM migrations');

    $command = $argv[1] ?? 'migrate';

    switch ($command) {
        case 'migrate':
            migrate($q);
            break;
        case 'rollback':
            rollback($q);
            break;
        default:
            echo "Invalid command. Please use 'migrate' or 'rollback'.";
    }
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
