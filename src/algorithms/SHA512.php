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

class SHA512 extends Algorithm
{
    /**
     * Get the hash
     *
     * @return string
     */
    public function hash()
    {
        return hash('sha512', $this->getInput());
    }
}