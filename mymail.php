<?php
require 'vendor/autoload.php';
use Mailgun\Mailgun;


$mgClient = new Mailgun('key-de8f8f419e0ef6bb22e3af2a11383e83');
$domain = "mail.computergurus.co.uk";


$result = $mgClient->sendMessage($domain, array(
    'from'    => 'Excited User <mailgun@mail.computergurus.co.uk>',
    'to'      => 'Baz <nasir999@hotmail.com>',
    'subject' => 'Hello',
    'text'    => 'Testing some Mailgun awesomness!'
));