<?php
namespace Bank\DB;
use Bank\DB\JsonDB;
use Bank\Messages as M;
 
class Validator
{
    private $nextID;

    public function __construct()
    {
        $nextID = (new JsonDB('accounts'))->getNextID();
    }

    public function validAccount(array $account)
    {
        $valid = true;

        if (!$this->validFName($account))
            $valid = false;

        if (!$this->validLName($account))
            $valid = false;

        if (!$this->validEmail($account))
            $valid = false;

        if (!$this->validPersonalID($account))
            $valid = false;

        if (!$this->validAccountNumber($account))
            $valid = false;

        if (!$this->validPass($account))
            $valid = false;

        return $valid;
    }

    public function validFName(array $acc)
    {
        if (isset($acc['fname']) && strlen($acc['fname']) > 3)
            return true;

        M::add('Invalid first name. Must be longer than 3 characters', 'alert');
        return false;
    }

    public function validLName(array $acc)
    {
        if (isset($acc['lname']) && strlen($acc['lname']) > 3)
            return true;
            
        M::add('Invalid last name. Must be longer than 3 characters', 'alert');
        return false;
    }

    public function validPass(array $acc)
    {
        if (isset($acc['pass']) && strlen($acc['pass']) > 3)
            return true;
        
        M::add('Invalid password. Must be longer than 3 characters', 'alert');
        return false;
    }

    public function validEmail(array $acc)
    {
        if (!isset($acc['email']) || !filter_var($acc['email'], FILTER_VALIDATE_EMAIL))
        {
            M::add('Invalid email', 'alert');
            return false;
        }
        
        $data = (new JsonDB('accounts'))->showAll();
        foreach($data as $account)
        {
            if ($account['id'] != ($acc['id'] ?? $this->nextID) && $account['email'] == $acc['email'])
            {
                M::add('An account with this email already exists', 'alert');
                return false;
            }
        }
            
        return true;
    }

    public function validPersonalID(array $acc, $alerts = true)
    {
        if (!isset($acc['pnumber']))
        {
            if ($alerts)
                M::add('Invalid personal ID number', 'alert');
            return false;
        }

        if(!preg_match('/[0-9]{11}/', $acc['pnumber']) || strlen((string)$acc['pnumber']) != 11)
        {
            if ($alerts)
                M::add('Invalid personal ID number', 'alert');
            return false;
        }
        
        $data = (new JsonDB('accounts'))->showAll();
        foreach($data as $account)
        {
            if ($account['id'] != ($acc['id'] ?? $this->nextID) && $account['pnumber'] == $acc['pnumber'])
            {
                if ($alerts)
                    M::add('An account with this personal ID number already exists', 'alert');
                return false;
            }
        }

        return true;
    }

    public function validAccountNumber(array $acc, $alerts = true)
    {

        if(!isset($acc['anumber']) ||
        !preg_match('/LT[0-9]{2}01984[0-9]{11}/', $acc['anumber']) ||
         strlen((string)$acc['anumber']) != 20)
        {
            if ($alerts)
                M::add('Invalid IBAN', 'alert');
            return false;
        }
        
        foreach((new JsonDB('accounts'))->showAll() as $account)
        {
            if ($account['id'] != ($acc['id'] ?? $this->nextID) && $account['anumber'] == $acc['anumber'])
            {
                if ($alerts)
                    M::add('An account with this IBAN already exists', 'alert');
                return false;
            }
        }

        return true;
    }

    public function validDeposit($amount)
    {
        if (!is_float($amount) && !is_int($amount))
        {
            M::add('The amount must be a number', 'alert');
            return false;
        }

        if ($amount < 0.01)
        {
            M::add('The amount must be a positive number', 'alert');
            return false;
        }
        
        if($amount != floor($amount * 100) / 100)
        {
            M::add('Invalid number', 'alert');
            return false;
        }

        return true;
    }

    public function validWithdrawal(array $user, $amount)
    {
        if (!is_float($amount) && !is_int($amount))
        {
            M::add('The amount must be a number', 'alert');
            return false;
        }

        if ($amount < 0.01)
        {
            M::add('The amount must be a positive number', 'alert');
            return false;
        }
        
        if($amount != floor($amount * 100) / 100)
        {
            M::add('Invalid number', 'alert');
            return false;
        }

        if($amount > $user['funds'])
        {
            M::add('Insufficient funds', 'alert');
            return false;
        }

        return true;
    }
}