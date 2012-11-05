<?php

namespace AHS\BrowserIDBundle\Security\Firewall;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Http\Firewall\ListenerInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use AHS\BrowserIDBundle\Security\Authentication\Token\BrowserIDUserToken;

class BrowserIDListener implements ListenerInterface
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
        if ($request->get('browserid-assertion') != '') {

            $url        = 'https://browserid.org/verify';
            $assert     = $request->get('browserid-assertion');
            $audience   = $request->server->get('HTTP_HOST');

            $params = 'assertion='.$assert.'&audience='.urlencode($audience);
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
            curl_setopt($ch,CURLOPT_POST,2);
            curl_setopt($ch,CURLOPT_POSTFIELDS, $params);
            $result = (array)json_decode(curl_exec($ch));
            curl_close($ch);

            if ($result['status'] == 'okay') {
                $token = new BrowserIDUserToken();
                $token->setUser($result['email']);

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