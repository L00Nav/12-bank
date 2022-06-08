<?php
namespace Bank\Controllers;
use Bank\App;
use Bank\Messages as M;

class HomeController
{
    public function getit($param)
    {
        echo 'AAA: '.$param;
    }

    public function index()
    {
        $list = [];
        for($i = 0; $i < 10; $i++)
        {
            $list[] = rand(1000, 9999);
        }
        return App::view('home', [
            'title' => 'Alabama',
            'list' => $list]);
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

    public function form()
    {
        return App::view('form', ['messages' => M::get()]);
    }

    public function test()
    {
        return App::view('test');
    }

    public function doForm()
    {
        M::add('Great', 'success');
        M::add($_POST['alabama'], 'alert');
        //calculations
        return App::redirect('form');
    }
}