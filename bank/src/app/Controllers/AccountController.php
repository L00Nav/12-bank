<?php
namespace Bank\Controllers;
use Bank\DB\Validator;
use Bank\DB\JsonDB;
use Bank\App;
use Bank\Messages as M;

class AccountController
{
    //Get stuff
    private static JsonDB $userData, $adminData;

    public static function getUserDatabase()
    {
        return self::$userData ?? self::$userData = new JsonDB('accounts');
    }

    public static function getAdminDatabase()
    {
        return self::$adminData ?? self::$adminData = new JsonDB('admins');
    }

    public static function getUserData()
    {
        return isset($_SESSION['userID']) ? self::getUserDatabase()->show($_SESSION['userID']) : [];
    }

    public static function getAdmin()
    {
        return isset($_SESSION['adminID']) ? self::getAdminDatabase()->show($_SESSION['adminID']) : [];
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
        } while (!(new Validator)->validAccountNumber(['anumber' => $iban, 'id' => self::getUserDatabase()->getNextID()]));
        return $iban;
    }

    //User login
    public function showLogin()
    {
        if (self::auth())
        {
            return App::redirect('accounts');
        }
        return App::view('login', ['messages' => M::get()]);
    }

    public function doLogin()
    {
        $users = self::getUserDatabase()->showAll();
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
                self::authAdd($user['id']);
                M::add('Hello, '.$user->fname, 'success');
                return App::redirect('accounts');
            }
        }
        M::add("Invalid log-in credentials", 'alert');
        return App::redirect('login');
    }

    public function doLogout()
    {
        self::authRem();
        M::add('Logged out', 'success');
        return App::redirect('login');
    }

    public static function authAdd(int $id) {
        $_SESSION['auth'] = 1;
        $_SESSION['userID'] = $id;
    }

    public static function authRem() {
        unset($_SESSION['auth'], $_SESSION['userID']);
    }

    public static function auth() : bool {
        return isset($_SESSION['auth']) && $_SESSION['auth'] == 1;
    }

    public static function authName() : string {
        return self::getUserData()['fname'].' '.self::getUserData()['lname'];
    }

    //Admin login
    public function showAdminLogin()
    {
        if (self::adminAuth())
        {
            return App::redirect('accounts');
        }
        return App::view('adminLogin', ['messages' => M::get()]);
    }

    public function doAdminLogin()
    {
        $admins = self::getAdminDatabase()->showAll();
        foreach($admins as $admin)
        {
            if ($_POST['adminName'] != $admin['adminName'])
            {
                continue;
            }
            if (md5($_POST['adminPass']) != $admin['adminPass'])
            {
                M::add("Invalid log-in credentials 1", 'alert');
                return App::redirect('adminLogin');
            }
            else 
            {
                self::adminAuthAdd($admin['id']);
                M::add('Hello, '.$admin->adminName, 'success');
                return App::redirect('accounts');
            }
        }
        M::add("Invalid log-in credentials", 'alert');
        return App::redirect('adminLogin');
    }

    public function doAdminLogout()
    {
        self::adminAuthRem();
        M::add('Logged out', 'success');
        return App::redirect('login');
    }

    public static function adminAuthAdd(int $id) {
        $_SESSION['adminAuth'] = 1;
        $_SESSION['adminID'] = $id;
    }

    public static function adminAuthRem() {
        unset($_SESSION['adminAuth'], $_SESSION['adminID']);
    }

    public static function adminAuth() : bool {
        return isset($_SESSION['adminAuth']) && $_SESSION['adminAuth'] == 1;
    }

    //Account management
    public function createAccount()
    {
        $submittedInfo = [
        'fname' => $_POST['fname'],
        'lname' => $_POST['lname'],
        'email' => $_POST['email'],
        'pnumber' => $_POST['pnumber'],
        'anumber' => $_POST['anumber'],
        'pass' => $_POST['pass']];

        if((new Validator)->validAccount($submittedInfo))
        {
            $submittedInfo['pass'] = md5($submittedInfo['pass']);
            $submittedInfo['funds'] = 0;
            self::getUserDatabase()->create($submittedInfo);
            self::getUserDatabase()->save();

            M::add('Account created', 'success');
            return App::redirect('login');
        }
        else
        {
            return App::redirect('accountCreationForm');
        }
    }

    public function createAdminAccount()
    {
        $submittedInfo = [
        'adminName' => $_POST['adminName'],
        'adminPass' => $_POST['adminPass']];

        if ((new Validator)->validAdmin($submittedInfo))
        {
            $submittedInfo['adminPass'] = md5($submittedInfo['adminPass']);
            self::getAdminDatabase()->create($submittedInfo);
            self::getAdminDatabase()->save();
            M::add('Account created', 'success');
            return App::redirect('adminLogin');
        }
        else
        {
            return App::redirect('adminCreationForm');
        }

    }

    public function deposit()
    {
        $id = (int)$_SESSION['userID'];
        $amount = (float)$_POST['amount'];
        if ((new Validator)->validDeposit($amount))
        {
            $user = self::getUserData();
            if (count($user) == 0)
            {
                M::add('Account not found', 'alert');
                return App::redirect('addFunds');
            }
            $user['funds'] += $amount;
            self::getUserDatabase()->update($id, $user);
            self::getUserDatabase()->save();
            M::add('Funds deposited', 'success');
        }
        return App::redirect('addFunds');
    }

    public function withdraw()
    {
        $id = (int)$_SESSION['userID'];
        $amount = (float)$_POST['amount'];
        $user = self::getUserData();
        if (count($user) == 0)
        {
            M::add('Account not found', 'alert');
            return App::redirect('withdrawFunds');
        }
        if ((new Validator)->validWithdrawal($user, $amount))
        {
            $user['funds'] -= $amount;
            self::getUserDatabase()->update($id, $user);
            self::getUserDatabase()->save();
            M::add('Funds withdrawn', 'success');
        }
        return App::redirect('withdrawFunds');
    }
    
    //misc
    public function updateDisplay(int $id)
    {
        $userData = self::getUserDatabase()->show($id);
        $_SESSION['user']['fname'] = $userData['fname'];
        $_SESSION['user']['lname'] = $userData['lname'];
        $_SESSION['user']['email'] = $userData['email'];
        $_SESSION['user']['pnumber'] = $userData['pnumber'];
        $_SESSION['user']['anumber'] = $userData['anumber'];
        $_SESSION['user']['funds'] = $userData['funds'];
    } //better use something other than session
}