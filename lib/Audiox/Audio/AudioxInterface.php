<?php

/*
 * This file is part of the Audiox package.
 *
 * @author Mikko Tarvainen 2011 <mtarvainen@gmail.com>
 */

namespace Audiox\Audio;

interface AudioxInterface
{
    /**
     * Opens an existing file from $path
     *
     * @param string $path
     *
     * @return Audiox\Audio\AudioInterface
     */
    function open($path);

    /**
    * Sets encoder path in filesystem
    *
    * @param string $path
    *
    * @return Audiox\Audio\AudioInterface
    */
    function setBinaryPath($path);
}