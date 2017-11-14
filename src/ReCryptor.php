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
use ReCryptor\Objects\OutputReCryptor;


class ReCryptor
{
    /** @var array */
    private $registerAlgorithms = array();

    /** @var string|null */
    private $hash = null;

    /** @var string|null */
    private $input = null;

    /**
     * @param string $input
     * @return $this
     */
    public function setHash($input)
    {
        $this->hash = $input;
        return $this;
    }

    /**
     * @deprecated Use the method <i>setInput()</i>
     *
     * @param string $input
     *
     * @return $this
     */
    public function setClear($input)
    {
        trigger_error(__METHOD__ . '() is deprecated.', E_USER_DEPRECATED);
        return $this->setInput($input);
    }

    /**
     * @param string $input
     *
     * @return $this
    */
    public function setInput($input)
    {
        $this->input = $input;
        return $this;
    }

    /**
     * Register a new algorithm
     *
     * @param Algorithm $algorithm
     *
     * @return $this
     *
     * @throws AlgorithmIsExistsException
     */
    public function registerAlgorithm(Algorithm $algorithm)
    {
        if(in_array($algorithm->getClassBaseName(), $this->registerAlgorithms))
        {
            throw new AlgorithmIsExistsException('Algorithm \''.$algorithm->getClassBaseName().'\' is exists');
        }

        $this->registerAlgorithms[] = $algorithm;
        return $this;
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
            $object->setInput($this->input);
            $object->setHash($this->hash);

            if($object->isAlgorithm())
            {
                return $object->getClassBaseName();
            }
        }

        throw new AlgorithmNotFound();
    }

    /**
     * @param Algorithm|string $outputAlgorithm
     *
     * @return OutputReCryptor
     *
     * @throws AlgorithmNotFound
     */
    public function recrypt($outputAlgorithm)
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
        $outputAlgorithm->setInput($this->input);
        $outputHash = $outputAlgorithm->hash();

        $needReHash = $outputHash !== $this->hash;

        return new OutputReCryptor(
            $needReHash,
            $outputAlgorithm,
            $outputHash
        );
    }

    /**
     * @deprecated Use the method <i>getAlgorithms()</i>
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
     * @param string $name
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