<?php

namespace Simon\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SimonUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
