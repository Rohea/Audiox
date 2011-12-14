<?php

/*
 * This file is part of the Audiox package.
 *
 * @author Mikko Tarvainen 2011 <mtarvainen@gmail.com>
 */

namespace Audiox\FFmpeg;

use Audiox\Audio\AudioxInterface;
use Audiox\FFmpeg\Audio;
use Audiox\Exception\InvalidArgumentException;
use Adiox\Exception\RuntimeException;

final class Audiox implements AudioxInterface
{
    private $binaryPath;

    public function setBinaryPath($path)
    {
        if (!is_executable($path)) {
            throw new InvalidArgumentException(sprintf(
                'File %s isn\'t executable', $path
            ));
        }

        $this->binaryPath = $path;
    }

    public function open($path)
    {
        if (!is_file($path)) {
            throw new InvalidArgumentException(sprintf(
                'File %s doesn\'t exist', $path
            ));
        }

        try {
            $object = new Audio($path, $this->binaryPath);
        } catch (\Exception $e) {
            throw new RuntimeException(
                sprintf('Could not open path "%s"', $path), $e->getCode(), $e
            );
        }

        return $object;
    }
}