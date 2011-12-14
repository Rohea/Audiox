<?php

/*
 * This file is part of the Audiox package.
 *
 * @author Mikko Tarvainen 2011 <mtarvainen@gmail.com>
 */

namespace Audiox\Audio;

interface AudioInterface
{
    /**
    * Saves the audio at a specified path, the target file extension is used
    * to determine file format
    *
    * @param string $path
    * @param array  $options
    *
    * @return Audiox\Audio\AudioInterface
    */
    function save($path, array $options = array());

   /**
    * Convert file format
    *
    * @param string $path
    *
    * @return boolean
    */
    function convert($format, array $options = array());

}