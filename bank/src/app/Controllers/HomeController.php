<?php
namespace Bank\Controllers;
use Bank\App;
use Bank\Messages as M;
use Bank\DB\AccountsDB;
use Bank\Controllers\AccountController as AC;

class HomeController
{
    public function getit($param)
    {
        echo 'AAA: '.$param;
    }

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
        return App::view('accounts');
    }

    public function createAccount()
    {
        return App::view('createAccount', ['messages' => M::get(), 'iban' => (new AC)->getIBAN()]);
    }

    public function addFunds()
    {
        return App::view('addFunds');
    }

    public function withdrawFunds()
    {
        return App::view('withdrawFunds');
    }

    public function doForm()
    {
        M::add('Great', 'success');
        M::add($_POST['alabama'], 'alert');
        //calculations
        return App::redirect('form');
    }

    public function fourOhFour()
    {
        return App::view('404');
    }
}