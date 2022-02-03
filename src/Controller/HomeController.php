<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {

        // ldapsearch -H ldap://ldap.forumsys.com -D “cn=read-only-admin,dc=example,dc=com” -w password -x -LLL -b “dc=example,dc=com”
        // ldapsearch -H ldap://ldap.forumsys.com -D “dc=example,dc=com” -w password -x -LLL -b “dc=example,dc=com”

        $server = "ldap.forumsys.com";
        $port = "389";
        $racine = "dc=example,dc=com";
        $rootdn = "cn=read-only-admin,dc=example,dc=com";
        $rootpw = "password";


        $ldap = ldap_connect($server, $port);
        ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
        $bind = ldap_bind($ldap,$rootdn,$rootpw);
        $search = ldap_search($ldap,$racine,'(uid=gauss)');
        $result = ldap_get_entries($ldap, $search);
        //dd($result);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
