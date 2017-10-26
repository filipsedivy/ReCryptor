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

use ReCryptor\Exceptions\NotImplementedException;

class Register
{
    private $data = array();

    private static $instance = array();

    public static function getInstance($key = 'default')
    {
        if(!array_key_exists($key, self::$instance))
        {
            self::$instance[$key] = new self();
        }

        return self::$instance[$key];
    }

    public function add($value)
    {
        $this->data[] = $value;
    }

    public function set($value)
    {
        if(is_array($value))
        {
            $this->data = $value;
        }
        elseif(is_scalar($value))
        {
            $this->data[] = $value;
        }

        throw new NotImplementedException();
    }

    public function get()
    {
        return $this->data;
    }

    public function getIndex($index)
    {
        return $this->data[$index];
    }

    public function clear()
    {
        $this->data[] = array();
        return $this;
    }
}
