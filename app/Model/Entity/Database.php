<?php

namespace App\Model\Entity;

use PDO;

/**
 * @author Robson Lucas
 * Classe responsavel pela conexao com o banco de dados
 * @package App\Model\Entiny
 */
abstract class Database
{
	/**
	 * Retorna a instancia de PDO
	 * @return PDO 
	 */
	public static function get()
	{
		try {
			$pdo = new \PDO('mysql:host=db;dbname=crudphp', 'root', 'toor', [
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			]);
			return $pdo;
		} catch (\PDOException $e) {
			echo $e->getMessage();
		}
	}
}
