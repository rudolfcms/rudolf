<?php

namespace Rudolf\Modules\Users\One;

use Rudolf\Component\Html\Text;

class User
{
    /**
     * @var array User data
     */
    protected $user;

    /**
     * Constructor.
     *
     * @param array $user
     */
    public function __construct(array $user = [])
    {
        $this->setData($user);
    }

    /**
     * Set user data.
     *
     * @param array $user
     */
    public function setData($user)
    {
        $this->user = array_merge(
            [
                'id' => 0,
                'nick' => '',
                'first_name' => '',
                'surname' => '',
                'email' => '',
            ],
            (array) $user
        );
    }

    /**
     * Returns user ID.
     *
     * @return int
     */
    public function id()
    {
        return (int) $this->user['id'];
    }

    /**
     * Returns user nick.
     *
     * @param string $type null|raw
     *
     * @return string
     */
    public function nick($type = '')
    {
        $nick = $this->user['nick'];
        if ('raw' === $type) {
            return $nick;
        }

        return Text::escape($nick);
    }

    /**
     * Returns user first name.
     *
     * @param string $type null|raw
     *
     * @return string
     */
    public function firstName($type = '')
    {
        $firstName = $this->user['first_name'];
        if ('raw' === $type) {
            return $firstName;
        }

        return Text::escape($firstName);
    }

    /**
     * Returns user surname.
     *
     * @param string $type null|raw
     *
     * @return string
     */
    public function surname($type = '')
    {
        $surname = $this->user['surname'];
        if ('raw' === $type) {
            return $surname;
        }

        return Text::escape($surname);
    }

    /**
     * Returns user email.
     *
     * @param string $type null|raw
     *
     * @return string
     */
    public function email($type = '')
    {
        $email = $this->user['email'];
        if ('raw' === $type) {
            return $email;
        }

        return Text::escape($email);
    }
}
