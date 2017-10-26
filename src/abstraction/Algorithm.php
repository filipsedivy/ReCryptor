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

namespace ReCryptor\Abstraction;

use ReCryptor\Exceptions\NotImplementedException;

/**
 * Class Algorithm
 * @package FilipSedivy\ReCryptor\Abstraction
 */
abstract class Algorithm
{
    private $input = null;

    private $hash = null;

    /**
     * Get the hash
     * @return mixed
     */
    abstract public function hash();

    /**
     * Set salt
     * @param $input string
     * @return string
     * @throws NotImplementedException
     */
    public function setSalt($input)
    {
        throw new NotImplementedException("Method '".__CLASS__.":".__METHOD__."' not implemented");
    }

    /**
     * Get the current instance of the class
     * @return $this
     */
    public function getClass()
    {
        return $this;
    }

    public function getClassBaseName()
    {
        return (new \ReflectionClass($this->getClass()))->getShortName();
    }

    /**
     * Is this algorithm?
     * @return bool
     */
    public function isAlgorithm()
    {
        return $this->hash() === $this->getHash();
    }

    public function setInput($input)
    {
        $this->input = $input;
        return $this;
    }

    public function getInput()
    {
        return $this->input;
    }

    public function setHash($input)
    {
        $this->hash = $input;
        return $this;
    }

    public function getHash()
    {
        return $this->hash;
    }
}