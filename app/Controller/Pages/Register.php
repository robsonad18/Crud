<?php

namespace App\Controller\Pages;

use App\Utils\View;
use App\Utils\Session;
use App\Controller\Pages\Login;
use App\Model\Entity\TableKey;

/**
 * Responsavel por gerenciar cadastro de usuarios
 * 
 * @package App\Controller\Pages
 */
class Register extends Page
{
    /**
     * METDDO RESPONSAVEL POR RETORNAR O CONTEUDO DO FORMULARIO DE CADASTRO
     * 
     * @var App\Controller\Pages\funciton
     */
    static function getForm()
    {
        if (Session::isLogged() === false) return Login::getLogin();
        
        $authorizations = [];

        foreach (TableKey::getAll() as $value) {
            $authorizations[] = View::render('pages/list/authorization', [
                'id'        => $value['id'],
                'nome'      => $value['nome'],
                'valor'     => $value['valor'],
                'checked'   => ''
            ]);
        }

        $content = View::render('pages/form/register', [
            'listAuthorization'  => implode('', $authorizations),
            'SOURCE'             => parent::getPath()
        ]);

        return parent::getPage('Cadastro', $content);
    }
}
