<?php

namespace AHS\PersonaBundle\Security\Authentication\Token;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

class PersonaUserToken extends AbstractToken
{

    public function getCredentials()
    {
        return '';
    }
}