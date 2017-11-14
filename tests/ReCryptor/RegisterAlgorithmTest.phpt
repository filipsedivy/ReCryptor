<?php
/**
 * Test: ReCryptor.
 *
 * @testCase
 */

namespace ReCryptor;

use Tester\Assert;
use Tester\TestCase;

require_once __DIR__.'/../bootstrap.php';
require_once __DIR__.'/classes/MD5Salt.php';

class RegisterAlgorithmTest extends TestCase
{
    /** @var string Password from the form */
    private $inputPassword = 'MyPassword';

    /** @var string MD5 hash $this->inputPassword */
    private $inputHash = '48503dfd58720bd5ff35c102065a52d7';

    /** @var string MD5 hash $this->inputPassword + SuperSalt! */
    private $inputHashWithSalt = '05837ca0e538664e7b3edec1cd52c5c8';

    public function testNeedRehash()
    {
        $recryptor = new \ReCryptor();
        $recryptor->setHash($this->inputHash);
        $recryptor->setInput($this->inputPassword);

        $recryptor->registerAlgorithm(new \MD5Salt());

        $result = $recryptor->recrypt('MD5Salt');

        Assert::true($result->needRehash());
    }

    public function testNotNeedRehash()
    {
        $recryptor = new \ReCryptor();
        $recryptor->setHash($this->inputHashWithSalt);
        $recryptor->setInput($this->inputPassword);

        $recryptor->registerAlgorithm(new \MD5Salt());

        $result = $recryptor->recrypt('MD5Salt');

        Assert::false($result->needRehash());
    }
}

(new RegisterAlgorithmTest())->run();