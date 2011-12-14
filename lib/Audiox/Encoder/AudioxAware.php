<?php

/*
 * This file is part of the Audiox package.
 *
 * @author Mikko Tarvainen 2011 <mtarvainen@gmail.com>
 */

namespace Audiox\Encoder;

use Audiox\Audio\AudioxInterface;

abstract class AudioxAware implements EncoderInterface
{
    /**
     * An AudioxInterface instance.
     *
     * @var AudioxInterface
     */
    private $audiox;

    /**
     * Set AudioxInterface instance.
     *
     * @param AudioxInterface $audiox
     */
    public function setAudiox(AudioxInterface $audiox)
    {
        $this->audiox = $audiox;
    }

    /**
     * Get AudioxInterface instance.
     *
     * @return AudioxInterface
     * @throws Audiox\Exception\InvalidArgumentException
     */
    public function getAudiox()
    {
        if (!$this->audiox instanceof AudioxInterface) {
            throw new InvalidArgumentException(sprintf('In order to use %s pass an Audiox\Audio\AudioxInterface instance to filter constructor', get_class($this)));
        }
        return $this->audiox;
    }
}