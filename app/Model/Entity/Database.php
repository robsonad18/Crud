<?php

namespace App\Model\Entity;

use PDO;

/**
 * @author Robson Lucas
 * Classe responsavel pela conexao com o banco de dados
 * @package App\Model\Entiny
 */
class Database
{
	/**
	 * Retorna a instancia de PDO
	 * @return PDO 
	 */
	public static function get():PDO
	{
		try {
			$pdo = new \PDO('mysql:host=localhost;dbname=teste_php', 'root', '', [
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			]);
			return $pdo;
		} catch (\PDOException $e) {
			echo $e->getMessage();
		}
	}
}
