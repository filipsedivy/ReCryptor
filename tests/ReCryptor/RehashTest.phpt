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

class RehashTest extends TestCase
{
    /** @var string Password from the form */
    private $inputPassword = 'MyPassword';

    /** @var string MD5 hash $this->inputPassword */
    private $inputHash = '48503dfd58720bd5ff35c102065a52d7';

    public function testNeedRehash()
    {
        $recryptor = $this->getReCryptorObject();
        $result = $recryptor->recrypt('SHA1');
        Assert::true($result->needRehash());
    }

    public function testNotNeedRehash()
    {
        $recryptor = $this->getReCryptorObject();
        $result = $recryptor->recrypt('MD5');
        Assert::false($result->needRehash());
    }

    public function testHashFromGetHash()
    {
        $recryptor = $this->getReCryptorObject();
        $result = $recryptor->recrypt('MD5');
        Assert::same($result->getHash(), $this->inputHash);
    }

    /**
     * @return \ReCryptor
    */
    private function getReCryptorObject()
    {
        $recryptor = new \ReCryptor();
        $recryptor->setInput($this->inputPassword);
        $recryptor->setHash($this->inputHash);
        return $recryptor;
    }
}

(new RehashTest())->run();