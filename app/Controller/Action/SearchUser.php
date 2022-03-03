<?php

namespace App\Controller\Action;

use App\Model\Entity\TableUser;

/**
 * @author Robson Lucas
 * Busca usuario
 * 
 * @package App\Controller\Action
 */
class SearchUser
{
    /**
     * Processa operação
     * 
     * @return false|array 
     */
    static function proccess()
    {
        try {
            if (!isset($_POST)) {
                echo json_encode([
                    'status'    => 'error',
                    'response'  => 'Não a dados enviados(post está vazio)'
                ]);
                return false;
            }
            $input            = $_POST;
            $input['search']  = $input['search'] ?? '';

            return TableUser::search($input['search']);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}
