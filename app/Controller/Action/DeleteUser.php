<?php

namespace App\Controller\Action;

use App\Model\Entity\TableUser;

/**
 * @author Robson Lucas
 * Excluir usuario
 * 
 * @package App\Controller\Action
 */
class DeleteUser
{
    /**
     * Processa operação
     * 
     * @return bool 
     */
    public static function proccess()
    {
        try {
            if (!isset($_POST) || $_POST === null || !isset($_POST['id'])) {
                echo json_encode([
                    'status'    => 'error',
                    'response'  => 'Não a dados enviados(post está vazio)'
                ]);
                return false;
            }
            $input          = $_POST;
            $input['user']  = $input['id'] ?? '';

            if (TableUser::delete($input['id'])) {
                echo json_encode([
                    'status'    => 'sucesso',
                    'response'  => 'Excluido com sucesso!'
                ]);
                return true;
            }
            echo json_encode([
                'status'    => 'error',
                'response'  => 'Erro ao excluir'
            ]);
            return false;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}
