<?php
namespace Bank\Controllers;
use Bank\App;
use Bank\Messages as M;

class LoginController
{

    public function showLogin()
    {
        return App::view('login', ['messages' => M::get()]);
    }

    public function doLogin()
    {
        $users = json_decode(file_get_contents(__DIR__. '/../../data/database.json'));
        foreach($users as $user)
        {
            if ($_POST['email'] != $user->email)
            {
                continue;
            }
            if (md5($_POST['pass']) != $user->pass)
            {
                M::add("I can't believe you've done this 1", 'alert');
                return App::redirect('login');
            }
            else {
                App::authAdd($user);
                M::add('Hello, '.$user->fname, 'success');
                return App::redirect('accounts');
            }
        }
        M::add("I can't believe you've done this 2", 'alert');
        return App::redirect('login');
    }

    public function doLogout()
    {
        App::authRem();
        M::add('AtA', 'success');
        return App::redirect('login');
    }
}