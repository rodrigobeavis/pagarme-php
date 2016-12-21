<?php

namespace PagarMe\Sdk\Card\Request;

use PagarMe\Sdk\Request;

class CardGet implements Request
{
    /**
     * @var int | Identificador do cartão
     */
    private $cardId;

    /**
     * @param int $cardId
     */
    public function __construct($cardId)
    {
        $this->cardId = $cardId;
    }

    /**
     * @return array
     */
    public function getPayload()
    {
        return [];
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return sprintf('cards/%s', $this->cardId);
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return 'GET';
    }
}