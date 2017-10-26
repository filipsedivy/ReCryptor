<?php
/**
 * This file is part of the ReCryptor library.
 *
 * (c) Filip Sedivy <mail@filipsedivy.cz>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT
 * @author Filip Sedivy <mail@filipsedivy.cz>
 */

namespace ReCryptor\Exceptions;

abstract class OutputReCryptorException extends \Exception
{
    private $hash = null;

    private $clear = null;

    private $needRehash;

    /**
     * @return null
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @param null $hash
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
    }

    /**
     * @return null
     */
    public function getClear()
    {
        return $this->clear;
    }

    /**
     * @param null $clear
     */
    public function setClear($clear)
    {
        $this->clear = $clear;
    }

    /**
     * @return null
     */
    public function getNeedRehash()
    {
        if(!is_bool($this->needRehash)) throw new \InvalidArgumentException('Property needRehash is not bool type');
        return $this->needRehash;
    }

    /**
     * @param bool $needRehash
     */
    public function setNeedRehash($needRehash)
    {
        if(!is_bool($needRehash)) throw new \InvalidArgumentException('Property needRehash is not bool type');
        $this->needRehash = $needRehash;
    }



}