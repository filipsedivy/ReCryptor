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

class FNV1A32 extends Algorithm
{
    /**
     * Get the hash
     * @return mixed
     */
    public function hash()
    {
        return hash('fnv1a32', $this->getInput());
    }
}