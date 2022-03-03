<?php

namespace App\Model\Entity;

use Exception;
use PDOException;
use App\Model\Entity\Database;


/**
 * @author Robson Lucas
 * Resonsavel por ações da Tabela de chave
 * 
 * @package App\Model\Entiny
 */
abstract class TableKey
{

    /**
     * @author Robson Lucas
     * Responsavel por retornar a chave conforme o id informada
     * 
     * @return array 
     */
    static function get(int $id): array
    {
        try {
            $query = Database::get()->prepare("SELECT * FROM chave WHERE id = ?");
            $query->execute([
                $id,
            ]);
            $output = $query->fetch(\PDO::FETCH_ASSOC);
            return $output ?? [];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }




    /**
     * Retorna todas as chaves
     * 
     * @return array 
     */
    static function getAll(): array
    {
        try {
            $query = Database::get()->prepare("SELECT * FROM chave");
            $query->execute();
            $output = $query->fetchAll(\PDO::FETCH_ASSOC);
            return $output ?? [];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
