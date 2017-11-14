<?php

class MD5Salt extends \ReCryptor\Abstraction\Algorithm
{
    /**
     * Get the hash
     *
     * @return mixed
     */
    public function hash()
    {
        $md5 = new \ReCryptor\Algorithm\MD5();
        $md5->setInput($this->getInput() . 'SuperSalt!');
        return $md5->hash();
    }
}