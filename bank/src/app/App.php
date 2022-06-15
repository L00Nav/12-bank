<?php
namespace Bank;
use Bank\Controllers\HomeController;
use Bank\Controllers\AccountController;
use Bank\Messages;

class App
{
    const DOMAIN = 'omnicorp.bank.gov';
    const APP = __DIR__ . '/../';
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
        $data['loggedIn'] = self::auth();
        if($data['loggedIn'])
            $data['fullName'] = self::authName();
        extract($data);
        require __DIR__ .' /../views/'.$name.'.php';
    }

    public static function authAdd(array $user) {
        $_SESSION['auth'] = 1;
        $_SESSION['user'] = $user;
    }

    public static function authRem() {
        unset($_SESSION['auth'], $_SESSION['user']);
    }

    public static function auth() : bool {
        return isset($_SESSION['auth']) && $_SESSION['auth'] == 1;
    }

    public static function authName() : string {
        return $_SESSION['user']['fname'].' '.$_SESSION['user']['lname'];
    }

    public static function json(array $data = [])
    {
        header('Content-Type: application/json; charset-utf-8');
        echo json_encode($data);
    }

    public static function redirect(string $url = '')
    {
        header('Location: http://'.self::DOMAIN.'/'.$url, 0);
    }

    private static function route(array $uri)
    {
        $m = $_SERVER['REQUEST_METHOD'];

        //LOGIN

        if ('GET' == $m && count($uri) == 1 && $uri[0] === 'login')
        {
            if (self::auth())
            {
                return self::redirect('accounts');
            }
            return (new AccountController)->showLogin();
        }

        if ('POST' == $m && count($uri) == 1 && $uri[0] === 'login')
        {
            return (new AccountController)->doLogin();
        }

        if ('POST' == $m && count($uri) == 1 && $uri[0] === 'logout')
        {
            return (new AccountController)->doLogout();
        }


        if ('POST' == $m && count($uri) == 1 && $uri[0] === 'createAccount')
        {
            (new AccountController)->createAccount();
        }

        if ('POST' == $m && count($uri) == 1 && $uri[0] === 'deposit')
        {
            (new AccountController)->deposit();
        }

        if ('POST' == $m && count($uri) == 1 && $uri[0] === 'withdraw')
        {
            (new AccountController)->withdraw();
        }



        if (count($uri) == 1 && $uri[0] === '')
        {
            return (new HomeController)->index();
        }

        if ('GET' == $m && count($uri) == 1 && $uri[0] === 'json')
        {
            return (new HomeController)->indexJson();
        }

        if ('GET' == $m && count($uri) == 1 && $uri[0] === 'accounts')
        {
            return (new HomeController)->accounts();
        }

        if ('GET' == $m && count($uri) == 1 && $uri[0] === 'allAccounts')
        {
            return (new HomeController)->allAccounts();
        }

        if ('GET' == $m && count($uri) == 1 && $uri[0] === 'accountCreationForm')
        {
            return (new HomeController)->createAccount();
        }

        if ('GET' == $m && count($uri) == 1 && $uri[0] === 'addFunds')
        {
            return (new HomeController)->addFunds();
        }

        if ('GET' == $m && count($uri) == 1 && $uri[0] === 'withdrawFunds')
        {
            return (new HomeController)->withdrawFunds();
        }

        else
        {
            return (new HomeController)->fourOhFour();
        }
    }
}