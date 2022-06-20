<?php
namespace Bank\Controllers;
use Bank\App;
use Bank\Messages as M;
use Bank\DB\JsonDB;
use Bank\Controllers\AccountController as AC;

class HomeController
{
    public function index()
    {
        return App::view('login');
    }
    
    public function indexJson()
    {
        $list = [];
        for($i = 0; $i < 10; $i++)
        {
            $list[] = rand(1000, 9999);
        }
        return App::json([
            'title' => 'Json',
            'list' => $list]);
    }

    public function accounts()
    {
        if(AC::adminAuth())
            $data = AC::getUserDatabase()->showAll();
        else
            $data = [AC::getUserData()];
        return App::view('accounts', ['messages' => M::get(), 'accounts' => $data]);
    }

    public function allAccounts()
    {
        return App::view('allAccounts', ['allAccounts' => AC::getUserDatabase()->showAll()]);
    }

    public function createAccount()
    {
        return App::view('createAccount', ['messages' => M::get(), 'iban' => (new AC)->getIBAN()]);
    }

    public function createAdmin()
    {
        if (!AC::adminAuth())
        {
            M::add('You are not authorised to do that', 'alert');
            return App::redirect('adminLogin');
        }
        return App::view('createAdmin', ['messages' => M::get()]);
    }

    public function addFunds()
    {
        return App::view('addFunds', ['messages' => M::get(), 'account' => AC::getUserData()]);
    }

    public function withdrawFunds()
    {
        return App::view('withdrawFunds', ['messages' => M::get(), 'account' => AC::getUserData()]);
    }

    public function doForm()
    {
        M::add('Great', 'success');
        M::add($_POST['alabama'], 'alert');
        return App::redirect('form');
    }

    public function fourOhFour()
    {
        return App::view('404');
    }
}