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

class GOST_CRYPTO extends Algorithm
{
    /**
     * Get the hash
     * @return mixed
     */
    public function hash()
    {
        return hash('gost-crypto', $this->getInput());
    }
}