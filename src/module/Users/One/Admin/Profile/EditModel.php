<?php

namespace Rudolf\Modules\Users\One\Admin\Profile;

use Rudolf\Component\Auth\Auth;
use Rudolf\Framework\Model\AdminModel;

class EditModel extends AdminModel
{
    public function edit($id, $f)
    {
        $stmt = $this->pdo->prepare("
            UPDATE
                {$this->prefix}users
            SET
                nick = :nick,
                first_name = :first_name,
                surname = :surname,
                email = :email,
                active = :active
            WHERE
                id = :id
        ");
        $stmt->bindValue(':nick', $f['nick']);
        $stmt->bindValue(':first_name', $f['first_name']);
        $stmt->bindValue(':surname', $f['surname']);
        $stmt->bindValue(':email', $f['email']);
        $stmt->bindValue(':active', $f['active'], \PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function updatePassword($id, $password)
    {
        $auth = new Auth($this->pdo, $this->prefix);
        $hash = $auth->getPasswordHash($password);

        $stmt = $this->pdo->prepare("UPDATE {$this->prefix}users SET password = :password WHERE id = :id");
        $stmt->bindValue(':password', $hash);
        $stmt->bindValue('id', $id, \PDO::PARAM_INT);

        return $stmt->execute();

    }

    public function getUserInfoById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->prefix}users WHERE id =?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
