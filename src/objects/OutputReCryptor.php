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

namespace ReCryptor\Objects;

use ReCryptor\Abstraction\Algorithm;

class OutputReCryptor
{
    private $needRehash;

    private $inputHash;

    private $input;

    /** @var Algorithm */
    private $algo;

    /**
     * @return bool
     */
    public function getNeedRehash()
    {
        return $this->needRehash;
    }

    /**
     * @param bool $needRehash
     * @return OutputReCryptor
     */
    public function setNeedRehash($needRehash)
    {
        $this->needRehash = $needRehash;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInputHash()
    {
        return $this->inputHash;
    }

    /**
     * @param mixed $inputHash
     * @return OutputReCryptor
     */
    public function setInputHash($inputHash)
    {
        $this->inputHash = $inputHash;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * @param mixed $input
     * @return OutputReCryptor
     */
    public function setInput($input)
    {
        $this->input = $input;
        return $this;
    }

    /**
     * @return Algorithm
     */
    public function getAlgo()
    {
        return $this->algo;
    }

    /**
     * @param Algorithm $algo
     * @return OutputReCryptor
     */
    public function setAlgo(Algorithm $algo)
    {
        $this->algo = $algo;
        return $this;
    }

}