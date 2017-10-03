<?php

namespace ClassroomBundle;

use ClassroomBundle\DependencyInjection\ClassroomBundleExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ClassroomBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new ClassroomBundleExtension();
    }
}
