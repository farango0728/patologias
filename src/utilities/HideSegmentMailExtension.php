<?php


namespace App\utilities;


use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class HideSegmentMailExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('hide_segment', [$this, 'hideSegment'])
        ];
    }

    function hideSegment($email, $minLength = 3, $maxLength = 10, $mask = "***") {

        $atPos = strrpos($email, "@");
        $name = substr($email, 0, $atPos);
        $len = strlen($name);
        $domain = substr($email, $atPos);

        if (($len / 2) < $maxLength) $maxLength = ($len / 2);

        $shortenedEmail = (($len > $minLength) ? substr($name, 0, $maxLength) : "");
        return  "{$shortenedEmail}{$mask}{$domain}";
    }
}