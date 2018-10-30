<?php
/**
 * Created by PhpStorm.
 * User: asus)
 * Date: 30.10.2018
 * Time: 12:22
 */

namespace App\Service;


use Psr\Log\LoggerInterface;

class Greeting
{
    private $logger;
    /**
     * @var string
     */
    private $message;

    public function __construct(LoggerInterface $logger, string $message)
    {
        $this->logger = $logger;
        $this->message = $message;
    }

    public function greet($name){
        $this->logger->info("Greeted $name");
        return "{$this->message} $name";
    }
}