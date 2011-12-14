<?php

/*
 * This file is part of the Audiox package.
 *
 * @author Mikko Tarvainen 2011 <mtarvainen@gmail.com>
 */

namespace Audiox\Encoder;

use Audiox\Encoder\Basic\Convert;
use Audiox\Encoder\Basic\Save;
use Audiox\Audio\AudioInterface;
use Audiox\Audio\AudioxInterface;

final class Transformation implements EncoderInterface, AudioInterface
{
    /**
     * @var array
     */
    private $encoders = array();

    /**
     * An AudioxInterface instance.
     *
     * @var AudioxInterface
     */
    private $audiox;

    /**
     * Class constructor.
     *
     * @param AudioxInterface $audiox
     */
    public function __construct(AudioxInterface $audiox = null)
    {
        $this->audiox = $audiox;
    }

    /**
     * Applies a given EncoderInterface onto given AudioInterface and returns
     * modified AudioInterface
     *
     * @param Audiox\Encoder\EncoderInterface $encoder
     * @param Audiox\Audio\AudioInterface   $audio
     *
     * @return Audiox\Audio\AudioInterface
     * @throws Audiox\Exception\InvalidArgumentException
     */
    public function applyEncoder(AudioInterface $audio, EncoderInterface $encoder)
    {
        if ($encoder instanceof AudioxAware) {
            if ($this->imagine === null) {
                throw new InvalidArgumentException(sprintf(
                    'In order to use %s pass an Audiox\Audio\AudioInterface instance '.
                    'to Transformation constructor', get_class($encoder)
                ));
            }
            $encoder->setAudiox($this->audiox);
        }
        return $encoder->apply($audio);
    }

    /**
     * (non-PHPdoc)
     * @see Audiox\Encoder\EncoderInterface::apply()
     */
    public function apply(AudioInterface $audio)
    {
        return array_reduce(
            $this->encoders,
            array($this, 'applyEncoder'),
            $audio
        );
    }

    public function convert($format, array $options = array())
    {
        return $this->add(new Convert($format, $options));
    }

    /**
     * (non-PHPdoc)
     * @see Audiox\Audio\AudioInterface::save()
     */
    public function save($path, array $options = array())
    {
        return $this->add(new Save($path, $options));
    }

    /**
     * Registers a given EncoderInterface in an internal array of filters for
     * later application to an instance of AudioInterface
     *
     * @param Audiox\Encoder\EncoderInterface $filter
     *
     * @return Audiox\Encoder\Transformation
     */
    public function add(EncoderInterface $encoder)
    {
        $this->encoders[] = $encoder;

        return $this;
    }
}