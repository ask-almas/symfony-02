<?php
/**
 * Created by PhpStorm.
 * User: almas
 * Date: 11/12/18
 * Time: 3:14 PM
 */

namespace App\Event;

use App\Entity\User;
use Symfony\Component\EventDispatcher\Event;

class UserRegisterEvent extends Event{

    const NAME = 'user.register';

    /**
     * @var User
     */
    private $registeredUser;

    public function __construct(User $registeredUser){

        $this->registeredUser = $registeredUser;
    }

    /**
     * @return User
     */
    public function getRegisteredUser(): User
    {
        return $this->registeredUser;
    }
}