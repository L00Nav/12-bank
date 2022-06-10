<?php
namespace Bank\Controllers;
use Bank\App;
use Bank\Messages as M;

class AccountController
{
    public function createAccount(array $submittedInfo)
    {
        if (!file_exists(__DIR__. '/../../data/database.json'))
        {
            file_put_contents(__DIR__. '/../../data/database.json', json_encode([]));
        }

        $submittedInfo['pass'] = md5($submittedInfo['pass']);

        $database = json_decode(file_get_contents(__DIR__. '/../../data/database.json'));
        $database[] = $submittedInfo;
        file_put_contents(__DIR__. '/../../data/database.json', json_encode($database));

        M::add('Account created', 'success');
        App::redirect('login');
    }
}