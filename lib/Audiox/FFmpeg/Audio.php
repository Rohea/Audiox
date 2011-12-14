<?php

/*
 * This file is part of the Audiox package.
 *
 * @author Mikko Tarvainen 2011 <mtarvainen@gmail.com>
 */

namespace Audiox\FFmpeg;

use Audiox\Audio\AudioInterface;
use Audiox\Exception\InvalidArgumentException;
use Audiox\Exception\RuntimeException;

final class Audio implements AudioInterface
{
    private $file;
    private $binaryPath;
    private $tempFile;
    private $createdTempFiles;

    public function __construct($file, $binaryPath)
    {
        $this->binaryPath = $binaryPath;
        $this->file = $file;
        $this->createdTempFiles = array();
    }

    public function convert($format, array $options = array())
    {
        $tempFile = sys_get_temp_dir() . '/AudioxFFmpegConvert' . rand() . '.' . $format;

        if (!touch($tempFile)) {
            throw new RuntimeException('Conversion operation failed. Unable to read temporary file.');
        }

        $this->createdTempFiles[] = $tempFile;

        /**
         * Command explanations
         *
         * -y		Overwrite output files without asking
         * -i		Input file
         * -ab		Audio bitrate
         * -ac		Audio channels
         * -ar		Audio sampling frequency
         * -f		Output format
         * -acodec	Audio codec
         *
         */

        $defaultOptions = array(
            'bitrate' => '192',
            'channels' => 2,
            'sampling_frequency' => 44100
        );

        if ($options) {
             $options = array_merge($defaultOptions, $options);
        } else {
            $options = $defaultOptions;
        }

        $command = $this->binaryPath . ' -y -i %s -ab %s -ac %s -ar %s -f %s %s';
        system(sprintf(
            $command,
            escapeshellarg($this->file),
            escapeshellarg($options['bitrate'] . 'kb'),
            escapeshellarg($options['channels']),
            escapeshellarg($options['sampling_frequency']),
            escapeshellarg($format),
            escapeshellarg($tempFile)
        ), $status);

        if ($status != 0) {
            throw new RuntimeException('Conversion operation failed. Unable to convert file to ' . $format . '.');
        }

        $this->file = $tempFile;

        return $this;
    }

    public function save($path, array $options = array())
    {
        if (is_file($this->file) && isset($path)) {

            if (!touch($path)) {
                throw new RuntimeException('Save operation failed. Unable to create ' . $path . '.');
            }

            if (!fopen($this->file, 'r')) {
                throw new RuntimeException('Save operation failed. Unable to read ' . $this->file . '.');
            }

            $save = file_put_contents($path, file_get_contents($this->file));

            if (!$save) {
                throw new RuntimeException('Save operation failed. Unable to write ' . $path . '.');
            }
        }

        return $this;
    }

    public function __destruct()
    {
        if (count($this->createdTempFiles) > 0) {

            foreach ($this->createdTempFiles as $file) {
                unlink($file);
            }
        }
    }
}