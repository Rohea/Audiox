<?php

/*
 * This file is part of the Audiox package.
 *
 * @author Mikko Tarvainen 2011 <mtarvainen@gmail.com>
 */

namespace Audiox\Encoder\Basic;

use Audiox\Encoder\EncoderInterface;
use Audiox\Audio\AudioInterface;


class Save implements EncoderInterface
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var array
     */
    private $options;

    /**
     * Constructs Save filter with given path and options
     *
     * @param string $path
     * @param array  $options
     */
    public function __construct($path, array $options = array())
    {
        $this->path    = $path;
        $this->options = $options;
    }

    /**
     * (non-PHPdoc)
     * @see Audiox\Encoder\EncoderInterface::apply()
     */
    public function apply(AudioInterface $audio)
    {
        return $audio->save($this->path, $this->options);
    }
}
