<?php
namespace Bank\Controllers;
use Bank\DB\Validator;
use Bank\DB\JsonDB;
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
        $users = (new JsonDB('accounts'))->showAll();
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

    public function createAccount()
    {
        $submittedInfo = [
        'fname' => $_POST['fname'],
        'lname' => $_POST['lname'],
        'email' => $_POST['email'],
        'pnumber' => $_POST['pnumber'],
        'anumber' => $_POST['anumber'],
        'pass' => $_POST['pass'],];

        if((new Validator)->validAccount($submittedInfo))
        {
            $submittedInfo['pass'] = md5($submittedInfo['pass']);
            $submittedInfo['funds'] = 0;
            $db = new JsonDB('accounts');
            $db->create($submittedInfo);
            $db->save();

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
        } while (!(new Validator)->validAccountNumber(['anumber' => $iban, 'id' => (new JsonDB('accounts'))->getNextID()]));
        return $iban;
    }

    public function deposit()
    {
        $id = (int)$_SESSION['user']['id'];
        $amount = (float)$_POST['amount'];
        if ((new Validator)->validDeposit($amount))
        {
            $db = new JsonDB('accounts');
            $user = $db->show($id);
            if (count($user) == 0)
            {
                M::add('Account not found', 'alert');
                return App::redirect('addFunds');
            }
            $user['funds'] += $amount;
            $db->update($id, $user);
            $db->save();
            M::add('Funds deposited', 'success');
            self::updateDisplay($_SESSION['user']['id']);
        }
        return App::redirect('addFunds');
    }

    public function withdraw()
    {
        $id = (int)$_SESSION['user']['id'];
        $amount = (float)$_POST['amount'];
        $db = new JsonDB('accounts');
        $user = $db->show($id);
        if (count($user) == 0)
        {
            M::add('Account not found', 'alert');
            return App::redirect('withdrawFunds');
        }
        if ((new Validator)->validWithdrawal($user, $amount))
        {
            $user['funds'] -= $amount;
            $db->update($id, $user);
            $db->save();
            M::add('Funds withdrawn', 'success');
            self::updateDisplay($_SESSION['user']['id']);
        }
        return App::redirect('withdrawFunds');
    }

    public function updateDisplay(int $id)
    {
        $userData = (new JsonDB('accounts'))->show($id);
        $_SESSION['user']['fname'] = $userData['fname'];
        $_SESSION['user']['lname'] = $userData['lname'];
        $_SESSION['user']['email'] = $userData['email'];
        $_SESSION['user']['pnumber'] = $userData['pnumber'];
        $_SESSION['user']['anumber'] = $userData['anumber'];
        $_SESSION['user']['funds'] = $userData['funds'];
    } //better use something other than session
}