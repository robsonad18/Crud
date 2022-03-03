<?php

namespace App\Controller\Pages;

use App\Utils\View;

/**
 * Classe responsavel pelo controle das paginas
 * 
 * @package App\Controller\Pages
 */
class Page
{
    /**
     * Retorna o caminho do projeto
     * 
     * @return string 
     */
    protected static function getPath()
    {
        $httphost = $_SERVER['HTTP_HOST'] ?? 'localhost';
        switch ($httphost) {
            case 'localhost':
                return 'http://localhost/project/crud-jquery-php';
            default:
                return '';        
        }
    }


    /**
     * METDDO RESPONSAVEL POR RETORNAR O CONTEUDO DA PAGINA
     * 
     * @var App\Controller\Pages\funciton
     */
    static function getPage(string $title, $content)
    {
        return View::render('pages/page', [
            'title'   => $title,
            'content' => $content,
            'SOURCE'  => self::getPath()
        ]);
    }
}
