<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Database;

class TestDb extends Controller
{
    public function index()
    {
        try {
            $db = Database::connect();

            $query = $db->query("SHOW TABLES");

            $tables = $query->getResultArray();

            echo '<h1>Tablas en la base de datos:</h1><ul>';

            foreach ($tables as $table) {
                echo '<li>' . reset($table) . '</li>';
            }

            echo '</ul>';
        } catch (\Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
