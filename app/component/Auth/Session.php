<?php
namespace Rudolf\Component\Auth;

class Session
{
    private $pdo;
    private $prefix;
    private $config;

    private $cookieName = 'auth';

    public function __construct($pdo, $prefix, $config)
    {
        $this->pdo = $pdo;
        $this->prefix = $prefix;
        $this->config = $config;

        $this->table = $this->prefix . 'users_sessions';
    }

    /**
     * Add user session
     * 
     * @param array $user
     * 
     * @return bool
     */
    public function createSession($user)
    {
        $ip = $this->getIP();
        $useragent = $_SERVER['HTTP_USER_AGENT'];

        $session['cookie_hash'] = sha1($this->config['site_key'] . microtime());
        $session['hash'] = $this->cookieHash($session['cookie_hash']);

        $session['expire'] = date("Y-m-d H:i:s", strtotime($this->config['session_expire']));

        $cookie = new Cookie($this->cookieName);

        if (true === $cookie->isExist()) {
            $this->destroySession();
        }

        $cookie->setValue($session['cookie_hash']);
        $cookie->setExpire(strtotime($session['expire']));
        $cookie->setPath(DIR . '/');
        
        if (false === $cookie->create()) {
            return false;
        }

        $stmt = $this->pdo->prepare("INSERT INTO {$this->table} 
            (user_id,  hash,  expire,  ip,  useragent, cookie) VALUES 
            (:user_id, :hash, :expire, :ip, :useragent, :cookie)");
        $stmt->bindValue(':user_id', $user['id'], \PDO::PARAM_INT);
        $stmt->bindValue(':hash', $session['hash'], \PDO::PARAM_STR);
        $stmt->bindValue(':expire', $session['expire'], \PDO::PARAM_STR);
        $stmt->bindValue(':ip', $ip, \PDO::PARAM_STR);
        $stmt->bindValue(':useragent', $useragent, \PDO::PARAM_STR);
        $stmt->bindValue(':cookie', $session['cookie_hash'], \PDO::PARAM_STR);

        if (false === $stmt->execute()) {
            return false;
        }

        return true;
    }

    /**
     * Destroy session
     * 
     * @param string $hash Cookie hash
     * 
     * @return bool
     */
    public function destroySession()
    {
        $cookie = new Cookie($this->cookieName);
        $value = $cookie->getValue();
        $cookie->destroy();

        if (strlen($value) !== 40) {
            return false;
        }

        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE cookie = :cookie");
        $stmt->bindValue(':cookie', $value, \PDO::PARAM_STR);

        return $stmt->execute();
    }

    /**
     * Check session
     * 
     * @return bool
     */
    public function checkSession()
    {
        $cookie = new Cookie($this->cookieName);
        
        $cookie_value = $cookie->getValue();
        $ip = $this->getIP();
        $useragent = $_SERVER['HTTP_USER_AGENT'];

        #check lenght
        if (strlen($cookie_value) !== 40) {
            return false;
        }

        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE cookie = :cookie");
        $stmt->bindValue(':cookie', $cookie_value, \PDO::PARAM_STR);
        $stmt->execute();

        #any session exists
        if (0 === $stmt->rowCount()) {
            return false;
        }

        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        #check expire
        if (strtotime(date("Y-m-d H:i:s")) > strtotime($row['expire'])) {
            $this->destroySession();
            return false;
        }

        #check ip
        if ($ip !== $row['ip']) {
            return false;
        }

        if ($this->cookieHash($cookie_value) !== $row['hash']) {
            return false;
        }

        return true;
    }

    /**
    * Returns the UID 
    * 
    * @param string $hash
    *
    *  @return int $uid
    */
    public function getSessionUID($hash = false)
    {
        if (false === $hash) {
            $cookie = new Cookie($this->cookieName);
            $hash = $cookie->getValue();
        }

        $stmt = $this->pdo->prepare("SELECT user_id FROM {$this->table} WHERE cookie = ?");
        $stmt->execute(array($hash));

        if ($stmt->rowCount() == 0) {
            return false;
        }

        return $stmt->fetch(\PDO::FETCH_ASSOC)['user_id'];
    }

    /**
     * Hash cookie hash
     * 
     * @param string $cookie
     * 
     * @return string(64)
     */
    private function cookieHash($cookie)
    {
        return hash('sha256', $cookie . $this->config['site_key']);
    }

    /**
     * Get user ip address
     * 
     * @see https://www.chriswiegman.com/2014/05/getting-correct-ip-address-php/
     * 
     * @return string
     */
    public function getIP()
    {
        
        //Just get the headers if we can or else use the SERVER global
        if ( function_exists( 'apache_request_headers' ) ) {
            $headers = apache_request_headers();
        } else {
            $headers = $_SERVER;
        }
        //Get the forwarded IP if it exists
        if ( array_key_exists( 'X-Forwarded-For', $headers ) && filter_var( $headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) ) {
            $the_ip = $headers['X-Forwarded-For'];
        } elseif ( array_key_exists( 'HTTP_X_FORWARDED_FOR', $headers ) && filter_var( $headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 )
        ) {
            $the_ip = $headers['HTTP_X_FORWARDED_FOR'];
        } else {
            
            $the_ip = filter_var( $_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );
        }
        return $the_ip;
    }
}
