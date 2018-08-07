<?php

namespace Rudolf\Modules\Users\One\Admin\Profile;

use Rudolf\Component\Auth\Auth;
use Rudolf\Framework\Model\AdminModel;

class AddModel extends AdminModel
{
    public function add($p)
    {
        $auth = new Auth($this->pdo, $this->prefix);
        $hash = $auth->getPasswordHash($p['password']);

        $stmt = $this->pdo->prepare("INSERT INTO {$this->prefix}users SET
            nick = :nick, first_name = :first_name, surname = :surname, email = :email,
            password = :password, active = :active");
        $stmt->bindValue(':nick', $p['nick']);
        $stmt->bindValue(':first_name', $p['first_name']);
        $stmt->bindValue(':surname', $p['surname']);
        $stmt->bindValue(':email', $p['email']);
        $stmt->bindValue(':password', $hash);
        $stmt->bindValue(':active', $p['active']);
        $stmt->execute();

        return $this->pdo->lastInsertId();
    }
}
