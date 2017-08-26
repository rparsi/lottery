<?php


namespace Rahi\ApiBundle\Service\Security;


use Rahi\ApiBundle\Model\AbstractDataObject;

class RouteDTO extends AbstractDataObject
{
    public $url;
    public $text;

    public function __construct($url = null, $text = null)
    {
        $this->url = $url;
        $this->text = $text;
    }
}