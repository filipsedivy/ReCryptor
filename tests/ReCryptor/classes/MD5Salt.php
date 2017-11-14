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
        return md5($this->getInput() . 'SuperSalt!');
    }
}