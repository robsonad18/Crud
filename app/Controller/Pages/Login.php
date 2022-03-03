<?php

namespace App\Controller\Pages;

use App\Utils\Session;
use App\Utils\View;

/**
 * @author Robson Lucas
 * Responsavel por retornar o login do sistema
 * 
 * @package App\Controller\Pages
 */
class Login extends Page
{
    /**
     * METDDO RESPONSAVEL POR RETORNAR O CONTEUDO DA HOME
     * 
     * @var App\Controller\Pages\funciton
     */
    static function getLogin()
    {
        if (Session::isLogged() === true) {
            $content = View::render('pages/logged', [
                'SOURCE' => parent::getPath(),
                'title'  => 'Você já está logado'
            ]);
            return parent::getPage('Teste-php', $content);
        }

        $content = View::render('pages/login', [
            'urlImage'      => parent::getPath() . '/resource/View/image/logo_cliente.jpg',
            'urlSite'       => 'http://www.santri.com.br',
            'urlImageSite'  => parent::getPath() . '/resource/View/image/logo_santri.svg'
        ]);

        return parent::getPage('Teste-php', $content);
    }
}
