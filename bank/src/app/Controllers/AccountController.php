<?php
namespace Bank\Controllers;
use Bank\DB\Validator;
use Bank\DB\AccountsDB;
use Bank\App;
use Bank\Messages as M;

class AccountController
{
    public function showLogin()
    {
        return App::view('login', ['messages' => M::get()]);
    }

    public function doLogin()
    {
        $users = (new AccountsDB('accounts'))->showAll();
        foreach($users as $user)
        {
            if ($_POST['email'] != $user['email'])
            {
                continue;
            }
            if (md5($_POST['pass']) != $user['pass'])
            {
                M::add("Invalid log-in credentials", 'alert');
                return App::redirect('login');
            }
            else {
                App::authAdd($user);
                M::add('Hello, '.$user->fname, 'success');
                return App::redirect('accounts');
            }
        }
        M::add("Invalid log-in credentials", 'alert');
        return App::redirect('login');
    }

    public function doLogout()
    {
        App::authRem();
        M::add('Logged out', 'success');
        return App::redirect('login');
    }

    public function createAccount(array $submittedInfo)
    {
        if((new Validator)->validAccount($submittedInfo))
        {
            $submittedInfo['pass'] = md5($submittedInfo['pass']);
            $submittedInfo['funds'] = 0;
            (new AccountsDB('accounts'))->create($submittedInfo);

            M::add('Account created', 'success');
            return App::redirect('login');
        }
        else
        {
            return App::redirect('accountCreationForm');
        }
    }

    public function getIBAN()
    {
        $max = 20;
        $iban = '';
        do {
            $iban = 'LT';
            $iban .= (string)rand(0, 9);
            $iban .= (string)rand(0, 9);
            $iban .= '01984';
            for ($i = 0; $i < 11; $i++)
                $iban .= (string)rand(0, 9);
            $max--;
            if(!$max)
                return $iban;
        } while (!(new Validator)->validAccountNumber(array('anumber' => $iban, 'id' => (new AccountsDB('accounts'))->getNextID())));
        return $iban;
    }

    //add funds

    //withdraw funds
}