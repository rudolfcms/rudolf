<?php

namespace Rudolf\Component\Auth;

use PDO;

class Auth
{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * @var string
     */
    private $prefix;

    /**
     * @var array
     */
    private $config;

    /**
     * @var string
     */
    private $table;

    /**
     * @var Session
     */
    private $session;

    /**
     * Auth constructor.
     * @param PDO $pdo
     * @param string $prefix
     */
    public function __construct(PDO $pdo, $prefix = '')
    {
        $this->pdo = $pdo;
        $this->prefix = $prefix;
        $this->config = include CONFIG_ROOT.'/'.'auth.php';

        $this->table = $this->prefix.'users';

        $this->session = new Session($pdo, $prefix, $this->config);
    }

    /**
     * Login user.
     *
     * @param string $email
     * @param string $password
     *
     * @return int
     *             1 - logged in!
     *             2 - email not valid
     *             3 - password not valid
     *             4 - user not exist
     *             5 - email or password incorrect
     *             6 - account is inactive
     *             7 - unnamed error
     */
    public function login($email, $password)
    {

        #validation
        if (false === $this->validateEmail($email)) {
            return 2;
        } elseif (false === $this->validatePassword($password)) {
            return 3;
        }

        #get user data by email
        $userData = $this->getUserDataByEmail($email);
        if (false === $userData) {
            return 4;
        }

        #check password
        if (!password_verify($password, $userData['password'])) {
            return 5;
        }

        #check is user active
        if (false === $userData['active']) {
            return 6;
        }

        #create session
        if (false === $this->session->createSession($userData)) {
            return 7;
        }

        return 1;
    }

    /**
     * Logout current user.
     *
     * @return bool
     */
    public function logout()
    {
        return $this->session->destroySession();
    }

    /**
     * Check is session exists.
     *
     * @return bool
     */
    public function check()
    {
        return $this->session->checkSession();
    }

    /**
     * Get logged user info.
     *
     * @param int $uid User ID
     *                not set gives current logged user data
     *
     * @return array|bool
     */
    public function getUser($uid = false)
    {
        if (false === $uid) {
            $uid = $this->session->getSessionUID();
        }

        $stmt = $this->pdo->prepare("
            SELECT id,
                   nick,
                   first_name,
                   surname,
                   email,
                   active,
                   dt
            FROM {$this->table}
            WHERE id = :uid
        ");
        $stmt->bindValue(':uid', $uid, \PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (empty($data)) {
            return false;
        }

        return $data;
    }

    /**
     * Get password hash.
     *
     * @param string $password
     *
     * @return string
     */
    public function getPasswordHash($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * Get user data by email.
     *
     * @param string $email
     *
     * @return array|bool
     */
    public function getUserDataByEmail($email)
    {
        $stmt = $this->pdo->prepare("
            SELECT *
            FROM {$this->table}
            WHERE email = :email
        ");
        $stmt->bindValue(':email', $email, \PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if (empty($results[0])) {
            return false;
        }

        return $results[0];
    }

    /**
     * Validate email.
     *
     * @param string $email
     *
     * @return bool
     */
    public function validateEmail($email)
    {
        return true;
    }

    /**
     * Validate password.
     *
     * @param string $password
     *
     * @return bool
     */
    public function validatePassword($password)
    {
        return true;
    }
}
