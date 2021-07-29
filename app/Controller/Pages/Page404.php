<?php

namespace App\Controller\Pages;

use App\Utils\View;

/**
 * Retorna pagina 404 do sistema
 * 
 * @package App\Controller\Pages
 */
class Page404 extends Page
{
    /**
     * METDDO RESPONSAVEL POR RETORNAR O CONTEUDO DA PAGINA 404
     * 
     * @var App\Controller\Pages\funciton
     */
    public static function get404()
    {
        $content = View::render('pages/404', [
            'title'         => 'Pagina não encontrada - 404',
            'SOURCE'        => parent::getPath(),
            'urlSite'       => 'http://www.santri.com.br',
            'urlImageSite'  => parent::getPath() . '/resource/View/image/logo_santri.svg'
        ]);

        return parent::getPage('Erro', $content);
    }
}
