<?php

require __DIR__ . '/vendor/autoload.php';

use App\Controller\Pages\Listing;
use App\Controller\Pages\Login;
use App\Controller\Pages\Page404;
use App\Controller\Pages\Register;
use App\Controller\Pages\Update;

new class
{
    public function __construct()
    {
        if (!isset($_GET)) {
            return;
        }
        $url        = explode('/', $_GET['url'] ?? '');
        $realName   = $url[0];

        // Caso a url for referente a uma classe de ajax
        if ($url[0] === 'ajax') {
            array_shift($url);
            $class = implode('\\', $url);
            $class::proccess();
            return;
        }
        switch ($realName) {
            case null:
            case '':
                echo Login::getLogin();
                break;
            case 'listagem':
                echo Listing::getTable();
                break;
            case 'cadastro':
                echo Register::getForm();
                break;
            case 'edicao':
                echo Update::getForm();
                break;
            default:
                echo Page404::get404();
                break;
        }
    }
};
