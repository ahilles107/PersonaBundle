<?php

namespace AHS\PersonaBundle\Security\Firewall;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Http\Firewall\ListenerInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use AHS\PersonaBundle\Security\Authentication\Token\PersonaUserToken;

class PersonaListener implements ListenerInterface
{
    protected $securityContext;
    protected $authenticationManager;

    public function __construct(SecurityContextInterface $securityContext, AuthenticationManagerInterface $authenticationManager)
    {
        $this->securityContext = $securityContext;
        $this->authenticationManager = $authenticationManager;
    }

    public function handle(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        if ($request->get('persona-assertion') != '') {

            $assert     = $request->get('persona-assertion');
            $audience   = $request->server->get('HTTP_HOST');
            $params = 'assertion='.$assert.'&audience='.urlencode($audience);

            $browser = new Buzz\Browser();
            $response = $browser->post('https://persona.org/verify', array(), $params);

            if ($response['status'] == 'okay') {
                $token = new PersonaUserToken();
                $token->setUser($response['email']);

                try {
                    $returnValue = $this->authenticationManager->authenticate($token);

                    if ($returnValue instanceof TokenInterface) {
                        return $this->securityContext->setToken($returnValue);
                    } else if ($returnValue instanceof Response) {
                        return $event->setResponse($returnValue);
                    }
                } catch (AuthenticationException $e) {
                    // you might log something here
                }
            }
        }
    }
}