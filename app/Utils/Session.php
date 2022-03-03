<?php

namespace App\Utils;

/**
 * @author Robson Lucas
 * Responsavel por gerenciar as sessoes
 * 
 * @package App\Utils
 */
abstract class Session
{

    /**
     * Cria a sessão do usuario
     * 
     * @param string $user 
     * @return void 
     */
    static function createSession(string $user)
    {
        if (!isset($_SESSION) && !headers_sent()) {
            session_start();
        }

        $_SESSION['usuario']        = $user;
        $_SESSION['usuarioLogado']  = true;
    }



    /**
     * Verifica se está logado
     * 
     * @return bool 
     */
    static function isLogged(): bool
    {
        if (!isset($_SESSION) && !headers_sent()) {
            session_start();
        }

        if (isset($_SESSION['usuarioLogado']) && $_SESSION['usuarioLogado'] === true) {
            return $_SESSION['usuarioLogado'];
        }

        return false;
    }



    /**
     * Dostroy a sessão
     * 
     * @return bool 
     */
    static function destroy(): bool
    {
        if (!isset($_SESSION) && !headers_sent()) {
            session_start();
        }
        return session_destroy();
    }
}
