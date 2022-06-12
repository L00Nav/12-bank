<?php
namespace Bank\DB;
use Bank\DB\AccountsDB;
use Bank\Messages as M;
 
class Validator
{
    public function __construct()
    {
        
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
        
        $data = (new AccountsDB('accounts'))->showAll();
        foreach($data as $account)
        {
            if ($account['id'] != $acc['id'] && $account['email'] == $acc['email'])
            {
                M::add('An account with this email already exists', 'alert');
                return false;
            }
        }
            
        return false;
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
        
        $data = (new AccountsDB('accounts'))->showAll();
        foreach($data as $account)
        {
            if ($account['id'] != $acc['id'] && $account['pnumber'] == $acc['pnumber'])
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
        
        foreach((new AccountsDB('accounts'))->showAll() as $account)
        {
            if ($account['id'] != $acc['id'] && $account['anumber'] == $acc['anumber'])
            {
                if ($alerts)
                    M::add('An account with this IBAN already exists', 'alert');
                return false;
            }
        }

        return true;
    }
}//the default function of this is for data creation/editing operations, so don't worry about logins

    /*data:
        Account ID - handled by userDB
        fname
        lname
        email
        pnumber
        anumber
        pass
        funds - not relevant for creation, but will probably need functions later
    */