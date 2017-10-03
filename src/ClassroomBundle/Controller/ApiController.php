<?php

namespace ClassroomBundle\Controller;

use ClassroomBundle\Services\ClassroomService;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\FOSRestController;

class ApiController extends FOSRestController
{
    /**
     * @var ClassroomService
     * @Inject
     */
    private $classroomService;

    public function __construct(ClassroomService $classroomService)
    {
        $this->classroomService = $classroomService;
    }

    /**
     * @Get("/classrooms", )
     */
    public function listAction()
    {
        $view = $this->view([123]);

        return $this->handleView($view);
    }
}
