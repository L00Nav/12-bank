<?php
namespace Bank\DB;
 
class AccountsDB implements DataBase
{ 
    private $data, $id, $file;

    public function __construct(string $file)
    {
        $this->file = $file;
        if (!file_exists(__DIR__. '/'.$file.'.json'))
        {
            file_put_contents(__DIR__. '/'.$file.'.json', json_encode([]));
            file_put_contents(__DIR__. '/'.$file.'_id.json', 0);
        }
        $this->data = json_decode(file_get_contents(__DIR__. '/'.$file.'.json'), 1);
        $this->id = json_decode(file_get_contents(__DIR__. '/'.$file.'_id.json'), 1);
    }

    public function __destruct()
    {
        file_put_contents(__DIR__. '/'.$this->file.'.json', json_encode($this->data));
    }

    public function create(array $userData) : void
    {
        $id = $this->getID();
        file_put_contents(__DIR__. '/'.$this->file.'_id.json', $id);
        $userData['id'] = $id;
        $this->data[] = $userData;
    }

    private function getID()
    {
        $this->id++;
        return $this->id;
    }

    public function getNextID()
    {
        return $this->id + 1;
    }
 
    public function update(int $userId, array $userData) : void
    {
        foreach($this->data as $key => $user)
        {
            if($user['id'] == $userId)
            {
                $this->data[$key] = $userData;
                return;
            }
        }
    }
 
    public function delete(int $userId) : void
    {
        foreach($this->data as $key => $user)
        {
            if($user['id'] == $userId)
            {
                unset($this->data[$key]);
                break;
            }
        }
    }
 
    public function show(int $userId) : array
    {
        foreach($this->data as $user)
        {
            if($user['id'] == $userId)
            {
                return $user;
            }
        }
        return [];
    }
    
    public function showAll() : array
    {
        return $this->data;
    }
}
