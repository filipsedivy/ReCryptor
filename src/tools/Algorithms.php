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

namespace ReCryptor\Tools;

use ReCryptor\Abstraction\Algorithm;
use ReCryptor\Exceptions\AlgorithmIsExistsException;
use ReCryptor\Exceptions\AlgorithmNotImplementException;

class Algorithms
{
    /**
     * @return array
     * @throws AlgorithmIsExistsException
     */
    public static function getInternalAlgorithms()
    {
        $algorithms = array();
        $dirAlgorithms = __DIR__.'/../algorithms';
        foreach(glob($dirAlgorithms.'/*.php') as $class)
        {
            /** @var Algorithm $algorithm */
            $algorithm = Classes::getClassObjectFromFile($class);
            if(array_key_exists($algorithm->getClassBaseName(), $algorithms))
            {
                throw new AlgorithmIsExistsException('Algorithm \''.$algorithm->getClassBaseName().'\' is exists');
            }

            $algorithms[$algorithm->getClassBaseName()] = $algorithm;
        }

        return $algorithms;
    }

    /**
     * @param array|Register $externalAlgorithms
     * @return array
     * @throws AlgorithmIsExistsException
     * @throws AlgorithmNotImplementException
     */
    public static function mergeExternalAndInternalAlgorithms($externalAlgorithms = [])
    {
        $algorithms = self::getInternalAlgorithms();

        if($externalAlgorithms instanceof Register)
        {
            $externalAlgorithms = $externalAlgorithms->get();
        }

        foreach($externalAlgorithms as $name => $object)
        {
            if(array_key_exists($name, $algorithms))
            {
                throw new AlgorithmIsExistsException('Algorithm \''.$name.'\' is exists');
            }

            if(!($object instanceof Algorithm))
            {
                throw new AlgorithmNotImplementException();
            }

            /** @var Algorithm $object */
            $algorithms[$object->getClassBaseName()] = $object;
        }

        return $algorithms;
    }
}