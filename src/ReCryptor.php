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

use ReCryptor\Abstraction\Algorithm;
use ReCryptor\Exceptions\AlgorithmIsExistsException;
use ReCryptor\Exceptions\AlgorithmNotFound;
use ReCryptor\Exceptions\NeedReHashException;
use ReCryptor\Exceptions\NotNeedReHashException;


class ReCryptor
{
    /** @var array */
    private $registerAlgorithms = array();

    /** @var string */
    private $inputHash = null;

    /** @var string */
    private $inputClear = null;

    /**
     * @param $input string
     * @return $this
     */
    public function setHash($input)
    {
        $this->inputHash = $input;
        return $this;
    }

    /**
     * @param $input string
     *
     * @return $this
     */
    public function setClear($input)
    {
        $this->inputClear = $input;
        return $this;
    }

    public function registerAlgorithm(Algorithm $algorithm)
    {
        if(in_array($algorithm->getClassBaseName(), $this->registerAlgorithms))
        {
            throw new AlgorithmIsExistsException('Algorithm \''.$algorithm->getClassBaseName().'\' is exists');
        }

        $this->registerAlgorithms[] = $algorithm;
    }

    /**
     * @return null|string
     *
     * @throws AlgorithmNotFound
     */
    public function getAlgorithm()
    {
        $algorithms = $this->getAlgorithms();
        foreach($algorithms as $name => $object)
        {
            /** @var Algorithm $object */
            $object->setInput($this->inputClear);
            $object->setHash($this->inputHash);

            if($object->isAlgorithm())
            {
                return $object->getClassBaseName();
            }
        }

        throw new AlgorithmNotFound();
    }

    /**
     * @param $outputAlgorithm Algorithm|string
     * @param bool $exception
     *
     * @return mixed|null
     *
     * @throws AlgorithmNotFound
     * @throws NeedReHashException
     * @throws NotNeedReHashException
     */
    public function recrypt($outputAlgorithm, $exception = false)
    {
        if(is_string($outputAlgorithm))
        {
            $outputAlgorithm = $this->getAlgorithmByName($outputAlgorithm);
        }
        else
        {
            if(!($outputAlgorithm instanceof Algorithm))
            {
                throw new AlgorithmNotFound();
            }
        }

        /** @var Algorithm $outputAlgorithm */
        $outputAlgorithm->setInput($this->inputClear);
        $outputHash = $outputAlgorithm->hash();

        if($outputHash === $this->inputHash)
        {
            if($exception)
            {
                $notNeedReHash = new NotNeedReHashException();
                $notNeedReHash->setNeedRehash(false);
                $notNeedReHash->setHash($outputHash);
                $notNeedReHash->setClear($this->inputClear);
                throw $notNeedReHash;
            }
            return null;
        }
        else
        {
            if($exception)
            {
                $needReHash = new NeedReHashException();
                $needReHash->setNeedRehash(true);
                $needReHash->setHash($outputHash);
                $needReHash->setClear($this->inputClear);
                throw $needReHash;
            }
            return $outputHash;
        }
    }

    /**
     * @deprecated 1.1 Use the method <i>getAlgorithms()</i>
     *
     * @return array
    */
    public function getAvailableAlgorithms()
    {
        trigger_error(__METHOD__ . '() is deprecated.', E_USER_DEPRECATED);
        return $this->getAlgorithms();
    }

    /**
     * Obtain all algorithms
     *
     * @return array
    */
    public function getAlgorithms()
    {
        return ReCryptor\Tools\Algorithms::mergeExternalAndInternalAlgorithms($this->registerAlgorithms);
    }

    /**
     * @param $name string
     *
     * @return Algorithm
     *
     * @throws AlgorithmNotFound
     */
    private function getAlgorithmByName($name)
    {
        $algorithms = $this->getAlgorithms();
        foreach($algorithms as $algorithm)
        {
            /** @var Algorithm $algorithm */
            if($algorithm->getClassBaseName() === $name)
            {
                return $algorithm;
            }
        }
        throw new AlgorithmNotFound('Algorithm \''.$name.'\' not found');
    }
}