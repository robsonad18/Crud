<?php

namespace App\Controller\Action;

use App\Model\Entity\TableUser;
use App\Model\Entity\TableAuthorization;

/**
 * @author Robson Lucas
 * Cadastra usuario
 * 
 * @package App\Controller\Action
 */
class RegisterUser
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

            if (TableUser::post($input)) {
                $id = TableUser::lastInsertId();

                foreach ($input['authorization'] as $key => $value) {
                    $result = TableAuthorization::post($id, $value);
                }

                if ($result === false) {
                    echo json_encode([
                        'status'    => 'error',
                        'response'  => 'Não foi possivel cadastrar as autorizações'
                    ]);
                    return false;
                }

                echo json_encode([
                    'status'    => 'sucesso',
                    'response'  => 'Cadastrado com sucesso!'
                ]);
                return true;
            }
            echo json_encode([
                'status'    => 'error',
                'response'  => 'Erro ao cadastrar'
            ]);
            return false;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}
