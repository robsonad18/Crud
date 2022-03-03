<?php

namespace App\Model\Entity;

use Exception;
use PDOException;
use App\Model\Entity\Database;


/**
 * @author Robson Lucas
 * Resonsavel por ações da Tabela de usuarios
 * 
 * @package App\Model\Entiny
 */
abstract class TableUser
{

	private static $getIdInset;

	/**
	 * Responsavel por retornar os usuarios
	 * 
	 * @return array 
	 */
	static function get(array $input): array
	{
		try {
			$query = Database::get()->prepare("SELECT * FROM usuarios WHERE LOGIN = ? AND SENHA = ? AND ATIVO = 'S'");
			$query->execute([
				$input['user'],
				$input['pass']
			]);
			$output = $query->fetch(\PDO::FETCH_ASSOC);
			return $output ? $output : [];
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}




	/**
	 * Responsavel por retornar usuario conforme o ID passado
	 * 
	 * @return array 
	 */
	static function getUserById(int $id): array
	{
		try {
			$query = Database::get()->prepare("SELECT * FROM usuarios WHERE USUARIO_ID = ?");
			$query->execute([$id]);
			$output = $query->fetch(\PDO::FETCH_ASSOC);
			return $output ?? [];
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}



	/**
	 * Retorna todos os usuarios
	 * 
	 * @return array 
	 */
	static function getAll(): array
	{
		try {
			$query = Database::get()->prepare("SELECT * FROM usuarios ORDER BY USUARIO_ID DESC");
			$query->execute();
			$output = $query->fetchAll(\PDO::FETCH_ASSOC);
			return $output ?? [];
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}



	/**
	 * Responsavel por cadastrar os usuarios
	 * 
	 * @return bool 
	 */
	static function post(array $input): bool
	{
		try {
			$instance  = Database::get();
			$query     = $instance->prepare('INSERT INTO usuarios (LOGIN, ATIVO, NOME_COMPLETO) VALUES (?, ?, ?)');
			$query->execute([
				$input['user'],
				$input['ativo'],
				$input['name']
			]);

			self::$getIdInset = $instance->lastInsertId();

			return true;
		} catch (\PDOException $e) {
			echo $e->getMessage();
		}
	}



	/**
	 * Retorna o ID do item inserido
	 * 
	 * @return mixed 
	 */
	static function lastInsertId()
	{
		return self::$getIdInset;
	}




	/**
	 * Retorna os dados conforme a busca realizada
	 * 
	 * @param mixed $value 
	 * @return array 
	 */
	static function search($value): array
	{
		try {
			$query  = Database::get()->prepare("SELECT * FROM usuarios WHERE NOME_COMPLETO LIKE ? LIMIT 5");
			$query->execute(['%' . $value . '%']);
			$result = $query->fetchAll(\PDO::FETCH_ASSOC);
			return $result ?? [];
		} catch (\PDOException $e) {
			echo $e->getMessage();
		}
	}



	/**
	 * Responsavel por atualizar os usuarios
	 * 
	 * @return bool 
	 */
	static function put(array $input): bool
	{
		try {
			$query = Database::get()->prepare('UPDATE usuarios SET LOGIN = ?, NOME_COMPLETO = ?, ATIVO = ? WHERE USUARIO_ID = ?');
			return $query->execute([
				$input['user'],
				$input['name'],
				$input['ativo'],
				$input['id']
			]);
		} catch (\PDOException $e) {
			echo $e->getMessage();
		}
	}



	/**
	 * Responsavel por excluir um usuario
	 * 
	 * @return bool 
	 */
	static function delete(int $id): bool
	{
		try {
			$query = Database::get()->prepare('DELETE FROM usuarios WHERE USUARIO_ID = ?');
			return $query->execute([$id]);
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
}
