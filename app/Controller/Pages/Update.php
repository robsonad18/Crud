<?php

namespace App\Controller\Pages;

use App\Utils\View;
use App\Utils\Session;
use App\Controller\Pages\Login;
use App\Model\Entity\TableAuthorization;
use App\Model\Entity\TableKey;
use App\Model\Entity\TableUser;
use Exception;

/**
 * Responsavel por gerenciar a edição de usuarios
 * 
 * @package App\Controller\Pages
 */
class Update extends Page
{
    /**
     * METDDO RESPONSAVEL POR RETORNAR O CONTEUDO DA FORMULARIO DE EDIÇÃO
     * 
     * @var App\Controller\Pages\funciton
     */
    static function getForm()
    {
        if (Session::isLogged() === false) return Login::getLogin();
        
        if (!isset($_GET['id'])) throw new \Exception('ID não foi especificado');
        
        // Retorna o usuario a ser editado
        $userCurrent            = TableUser::getUserById($_GET['id']);
        $authorizationsCurrent  = array_column(TableAuthorization::get($_GET['id']), 'CHAVE_AUTORIZACAO');
        $authorizations         = [];

        // Seta e retorna checkbox de autorizações
        foreach (TableKey::getAll() as $value) {
            $authorizations[] = View::render('pages/list/authorization', [
                'id'        => $value['id'],
                'nome'      => $value['nome'],
                'valor'     => $value['valor'],
                'checked'   => in_array($value['valor'], $authorizationsCurrent) ? 'checked' : ''
            ]);
        }

        $authorizations = array_unique($authorizations);

        $content = View::render('pages/form/update', [
            'listAuthorization'  => implode('', $authorizations),
            'SOURCE'             => parent::getPath(),
            'id'                 => $userCurrent['USUARIO_ID'],
            'name'               => $userCurrent['NOME_COMPLETO'],
            'user'               => $userCurrent['LOGIN'],
            'selected1'          => $userCurrent['ATIVO'] === 'S' ? 'selected' : '',
            'selected2'          => $userCurrent['ATIVO'] === 'N' ? 'selected' : ''
        ]);

        return parent::getPage('Edição', $content);
    }
}
