<?php

namespace FWM\BrowserIDBundle\Security\Authentication\Token;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

class BrowserIDUserToken extends AbstractToken
{

    public function getCredentials()
    {
        return '';
    }
}