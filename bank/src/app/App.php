<?php
namespace Bank;
use Bank\Controllers\HomeController;
use Bank\Messages;

class App
{
    const DOMAIN = 'omnicorp.gov';
    private static $html;

    public static function start()
    {
        session_start();
        Messages::init();
        ob_start();
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        array_shift($uri);
        self::route($uri);
        self::$html = ob_get_contents();
        ob_end_clean();
    }

    public static function sent()
    {
        echo self::$html;
    }

    public static function view(string $name, array $data = [])
    {
        extract($data);
        require __DIR__ .' /../views/'.$name.'.php';
    }

    public static function json(array $data = [])
    {
        header('Content-Type: application/json; charset-utf-8');
        echo json_encode($data);
    }

    public static function redirect($url = '')
    {
        header('Location: http://'.self::DOMAIN.'/'.$url);
    }

    private static function route(array $uri)
    {
        $m = $_SERVER['REQUEST_METHOD'];

        if (count($uri) == 1 && $uri[0] === '')
        {
            return (new HomeController)->index();
        }

        if ('GET' == $m && count($uri) == 1 && $uri[0] === 'json')
        {
            return (new HomeController)->indexJson();
        }

        if ('GET' == $m && count($uri) == 2 && $uri[0] === 'get-it')
        {
            return (new HomeController)->getIt($uri[1]);
        }

        if ('GET' == $m && count($uri) == 1 && $uri[0] === 'form')
        {
            return (new HomeController)->form();
        }

        if ('GET' == $m && count($uri) == 1 && $uri[0] === 'test')
        {
            return (new HomeController)->test();
        }

        if ('POST' == $m && count($uri) == 1 && $uri[0] === 'form')
        {
            return (new HomeController)->doForm();
        }

        else
        {
            echo 'kitka';
        }
    }
}