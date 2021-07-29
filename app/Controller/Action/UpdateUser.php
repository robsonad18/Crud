<?php

namespace App\Controller\Action;

use App\Model\Entity\TableUser;
use App\Model\Entity\TableAuthorization;

/**
 * Atualiza usuario
 * 
 * @package App\Controller\Action
 */
class UpdateUser
{
    /**
     * Processa operação
     * 
     * @return bool 
     */
    public static function proccess()
    {
        try {
            if (!isset($_POST) || $_POST === null) {
                echo json_encode([
                    'status'    => 'error',
                    'response'  => 'Não a dados enviados(post está vazio)'
                ]);
                return false;
            }

            $input                   = $_POST;
            $input['user']           = $input['user'] ?? '';
            $input['name']           = $input['name'] ?? '';
            $input['ativo']          = $input['ativo'] ?? '';
            $input['authorization']  = $input['authorization'] ?? '';
            $input['id']             = $input['id'] ?? '';

            if (TableUser::put($input)) {
                $result = TableAuthorization::newAuthorization($input['id'], $input['authorization']);

                if ($result === false) {
                    echo json_encode([
                        'status'    => 'error',
                        'response'  => 'Não foi possivel atualizar as autorizações'
                    ]);
                    return false;
                }

                echo json_encode([
                    'status'    => 'sucesso',
                    'response'  => 'Atualizado com sucesso!'
                ]);
                return true;
            }
            echo json_encode([
                'status'    => 'error',
                'response'  => 'Erro ao atualizar'
            ]);
            return false;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}
