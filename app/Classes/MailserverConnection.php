<?php
/**
* Created by PhpStorm.
* User: simon.proud@ro.ru
* Date: 12.12.18
* Time: 18:36
*/

namespace App\Classes;


class MailserverConnection
{
    private $user;

    public  function  __construct($user)
    {
    $this->userId = $user;
    }


}