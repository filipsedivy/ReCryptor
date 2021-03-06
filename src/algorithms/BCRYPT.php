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

namespace ReCryptor\Algorithm;

use ReCryptor\Abstraction\Algorithm;

class BCRYPT extends Algorithm
{
    /**
     * Is this algorithm?
     *
     * @return bool
     */
    public function isAlgorithm()
    {
        return password_verify($this->getInput(), $this->getHash());
    }

    /**
     * Get the hash
     *
     * @return string
     */
    public function hash()
    {
        return password_hash($this->getInput(), PASSWORD_BCRYPT);
    }
}