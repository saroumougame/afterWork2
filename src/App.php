<?php

namespace App;


use Symfony\Component\HttpKernel\Bundle\Bundle;

class App extends Bundle
{
public function getParent()
{
return 'FOSUserBundle';
}
}