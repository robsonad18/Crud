<?php

namespace App\Controller\Validate;

use App\Model\Entity\TableUser;
use App\Utils\Session;


/**
 * Responsavel por realizar os processos e logar o usuario
 * 
 * @package App\Controller\Validate
 */
class UserLogin
{

    static function proccess():bool
    {
        try {
            if (!isset($_POST) || $_POST === null) {
                echo json_encode([
                    'status'    => 'error',
                    'response'  => 'Não a dados enviados(post está vazio)'
                ]);
                return false;
            }

            $input          = $_POST;
            $input['user']  = $input['user'] ?? '';
            $input['pass']  = $input['pass'] ?? '';

            $existsUser = TableUser::get($input);

            if (empty($existsUser) || $existsUser === null) {
                echo json_encode([
                    'status'    => 'error',
                    'response'  => 'Usuario não encontrado'
                ]);
                return false;
            }

            Session::createSession($input['user']);

            echo json_encode([
                'status'    => 'sucesso',
                'response'  => 'Logado com sucesso'
            ]);
            return true;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}
