<?php
namespace App\utilities;

use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class CsrfExtension extends AbstractExtension implements GlobalsInterface
{
    protected $csrf;

    public function __construct(\Slim\Csrf\Guard $csrf)
    {
        $this->csrf = $csrf;
    }

    public function getGlobals(): array
    {
        $csrfNameKey = $this->csrf->getTokenName();
        $csrfValueKey = $this->csrf->getTokenValue();
        $csrfName = $this->csrf->getTokenName();
        $csrfValue = $this->csrf->getTokenValue();

        return [
            'csrf'   => [
                'keys' => [
                    'name'  => 'csrf_name',
                    'value' => 'csrf_value'
                ],
                'name'  => $csrfName,
                'value' => $csrfValue
            ]
        ];
    }


}