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
    /** @var bool */
    private $needRehash;

    /** @var Algorithm */
    private $newAlgorithm;

    /** @var string */
    private $hash;

    /**
     * @param bool      $needRehash
     * @param Algorithm $newAlgorithm
     * @param string    $hash
     */
    public function __construct($needRehash, Algorithm $newAlgorithm, $hash)
    {
        $this->needRehash = $needRehash;
        $this->newAlgorithm = $newAlgorithm;
        $this->hash = $hash;
    }

    /**
     * @return bool
     */
    public function getNeedRehash()
    {
        return $this->needRehash;
    }

    /**
     * @return Algorithm
     */
    public function getNewAlgorithm()
    {
        return $this->newAlgorithm;
    }

    /**
     * @return string
    */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @return bool
     */
    public function needRehash()
    {
        return $this->needRehash;
    }
}