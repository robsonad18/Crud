<?php

namespace App\Controller\Pages;

use App\Utils\View;
use App\Utils\Session;
use App\Controller\Pages\Login;
use App\Model\Entity\TableUser;

/**
 * @author Robson Lucas
 * Classe responsavel pela listagem do sistema
 * 
 * @package App\Controller\Pages
 */
class Listing extends Page
{
    /**
     * METDDO RESPONSAVEL POR RETORNAR O CONTEUDO DA LISTA
     * 
     * @var App\Controller\Pages\funciton
     */
    static function getTable()
    {
        if (Session::isLogged() === false) return Login::getLogin();
        
        $valueUser = [];

        $users = !empty($_GET['busca']) ? TableUser::search($_GET['busca']) : TableUser::getAll();

        foreach ($users as $value) {
            $valueUser[] = View::render('pages/list/user', [
                'name'   => $value['NOME_COMPLETO'],
                'login'  => $value['LOGIN'],
                'status' => $value['ATIVO'] === 'S' ? 'Ativo' : 'Inativo',
                'id'     => $value['USUARIO_ID']
            ]);
        }

        $content = View::render('pages/listing', [
            'trUsers'  => implode('', $valueUser),
            'search'   => $_GET['busca'] ?? '',
            'SOURCE'   => parent::getPath()
        ]);

        return parent::getPage('Listagem', $content);
    }
}
