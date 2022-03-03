<?php

namespace App\Model\Entity;

use App\Model\Entity\Database;
use PDOException;


/**
 * @author Robson Lucas
 * Responsavel por ações da tabela de autorizacoes
 * 
 * @package App\Model\Entiny
 */
abstract class TableAuthorization
{
    /**
     * Retorna todas as autorizações
     * 
     * @return array|void 
     */
    static function getAll(): array
    {
        try {
            $query = Database::get()->prepare("SELECT * FROM autorizacoes");
            $query->execute();
            $output = $query->fetchAll(\PDO::FETCH_ASSOC);
            return $output ?? [];
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }



    /**
     * Retorna autorização conforme o ID do usuario informado
     * 
     * @param int $idUser 
     * @return array|void 
     */
    static function get(int $idUser): array
    {
        try {
            $query = Database::get()->prepare("SELECT * FROM autorizacoes WHERE USUARIO_ID = ?");
            $query->execute([$idUser]);
            $output = $query->fetchAll(\PDO::FETCH_ASSOC);
            return $output ?? [];
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }




    /**
     * Cria novas autorizações dependendo da lista passada
     * 
     * @param int $idUser 
     * @param array $input 
     * @return bool|void 
     */
    static function newAuthorization(int $idUser, array $input)
    {
        try {
            $queryDelete = Database::get()->prepare('DELETE FROM autorizacoes WHERE USUARIO_ID = ?');

            if (($queryDelete->execute([$idUser])) === false) {
                return false;
            }

            foreach ($input as $value) {
                $result = self::post($idUser, $value);
            }

            return $result === true ? true : false;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }




    /**
     * Cadastrar nova autorização
     * 
     * @param int $idUser 
     * @param string $name 
     * @return bool 
     */
    static function post(int $idUser, string $name): bool
    {
        try {
            $query = Database::get()->prepare('INSERT INTO autorizacoes(USUARIO_ID, CHAVE_AUTORIZACAO)VALUES(? , ?)');
            return $query->execute([
                $idUser,
                $name
            ]);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}
