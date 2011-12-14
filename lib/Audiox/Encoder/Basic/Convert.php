<?php

/*
 * This file is part of the Audiox package.
 *
 * @author Mikko Tarvainen 2011 <mtarvainen@gmail.com>
 */

namespace Audiox\Encoder\Basic;

use Audiox\Encoder\EncoderInterface;
use Audiox\Audio\AudioInterface;

class Convert implements EncoderInterface
{
    public function __construct($format, array $options = array())
    {
        $this->format = $format;
        $this->options = $options;
    }

    /**
     * (non-PHPdoc)
     * @see Audiox\Encoder\EncoderInterface::apply()
     */
    public function apply(AudioInterface $audio)
    {
        return $audio->convert($this->format, $this->options);
    }
}