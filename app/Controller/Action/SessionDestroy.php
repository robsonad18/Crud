<?php

namespace App\Controller\Action;

use App\Utils\Session;

/**
 * Destroy sessão do usuario
 * 
 * @package App\Controller\Action
 */
class SessionDestroy
{
    /**
     * Processa operação
     * 
     */
    public static function proccess()
    {
        if ((Session::destroy()) === false) {
            echo json_encode([
                'status' => 'error'
            ]);
            return false;
        }

        echo json_encode(['status' => 'sucesso']);
        return true;
    }
};
