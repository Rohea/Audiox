<?php

/*
 * This file is part of the Audiox package.
 *
 * @author Mikko Tarvainen 2011 <mtarvainen@gmail.com>
 */

namespace Audiox\Encoder;

use Audiox\Audio\AudioInterface;

interface EncoderInterface
{
    /**
     * Applies scheduled transformation to AudioInterface instance
     * Returns processed AudioInterface instance
     *
     * @param Audiox\Audio\AudioInterface $audio
     *
     * @return Audiox\Audio\AudioInterface
     */
    function apply(AudioInterface $audio);
}