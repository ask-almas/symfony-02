<?php
/**
 * Created by PhpStorm.
 * User: almas
 * Date: 11/15/18
 * Time: 10:35 AM
 */

namespace App\Tests\Security;

use App\Security\TokenGenerator;
use PHPUnit\Framework\TestCase;

class TokenGeneratorTest extends TestCase{

    public function testTokenGeneration(){
        $tokenGen = new TokenGenerator();
        $token = $tokenGen->getRandomSecureToken(30);

        $this->assertEquals(30, strlen($token));
        $this->assertTrue(ctype_alnum($token));

    }
}