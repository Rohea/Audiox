#Audiox#

Audio manipulation library for PHP 5.3 inspired by Imagine library

##Requirements##

The Audiox library has the following requirements:

 - PHP 5.3+
 - ffmpeg

##Basic Principles##

The main purpose of Audiox is to provide necessary functionality for audio processing in PHP with simple and intuitive OO API.

##Example usage##
```php
<?php

$audioxObject = new Audiox\FFmpeg\Audiox();
$audioxObject->setBinaryPath('/usr/bin/ffmpeg');

$transformationObject = new Audiox\Encoder\Transformation();
$transformationObject->convert('mp3')->save('/tmp/my_test.mp3');
$transformationObject->apply($audioxObject->open('/tmp/my_uploaded_audio_file'));
```