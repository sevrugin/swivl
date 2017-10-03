<?php

namespace ClassroomBundle\Controller;

use ClassroomBundle\Services\ClassroomService;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends FOSRestController
{
    /**
     * Create classroom
     *
     * @ApiDoc(
     *     section="Classroom",
     *     authentication=false,
     *     parameters={
     *        {"name"="name", "dataType"="string", "required"=true, "description"="Classroom name"},
     *        {"name"="is_active", "dataType"="boolean", "required"=true, "description"="Classroom is active"}
     *     },
     *     description="Create classroom",
     *     statusCodes={
     *         200="Returned when request is successful",
     *         400="Returned when bad request received",
     *         405="Returned when method not allowed"
     *    }
     *  )
     *
     * @param Request $request
     * @return Response
     *
     * @Put("/classroom", )
     */
    public function createAction(Request $request)
    {
        $name = trim($request->get('name'));
        $isActive = (bool)$request->get('is_active');

        if (!strlen($name)) {
            throw new \InvalidArgumentException('"name" parameter must be not empty string');
        }

        /** @var ClassroomService $classroomService */
        $classroomService = $this->get('classroom.service');

        $classroomService->create($name, $isActive);
        $view = $this->view([], Response::HTTP_OK);

        return $this->handleView($view);
    }

    /**
     * Edit classroom
     *
     * @ApiDoc(
     *     section="Classroom",
     *     authentication=false,
     *     parameters={
     *        {"name"="name", "dataType"="string", "required"=true, "description"="Classroom name"},
     *        {"name"="is_active", "dataType"="boolean", "required"=true, "description"="Classroom is active"}
     *     },
     *     description="Edit classroom",
     *     statusCodes={
     *         200="Returned when request is successful",
     *         400="Returned when bad request received",
     *         405="Returned when method not allowed"
     *    }
     *  )
     *
     * @param Request $request
     * @return Response
     *
     * @Post("/classroom/{id}", )
     */
    public function editAction(Request $request)
    {
        $id = (int)$request->get('id');
        $name = trim($request->get('name'));
        $isActive = (bool)$request->get('is_active');

        if (! $id){
            throw new \InvalidArgumentException('"id" must be not empty numeric value');
        }
        if (!strlen($name)) {
            throw new \InvalidArgumentException('"name" parameter must be not empty string');
        }

        /** @var ClassroomService $classroomService */
        $classroomService = $this->get('classroom.service');

        $classroomService->edit($id, $name, $isActive);
        $view = $this->view([], Response::HTTP_OK);

        return $this->handleView($view);
    }

    /**
     * Delete classroom
     *
     * @ApiDoc(
     *     section="Classroom",
     *     authentication=false,
     *     parameters={
     *     },
     *     description="Delete classroom",
     *     statusCodes={
     *         200="Returned when request is successful",
     *         400="Returned when bad request received",
     *         405="Returned when method not allowed"
     *    }
     *  )
     *
     * @param Request $request
     * @return Response
     *
     * @Delete("/classroom/{id}", )
     */
    public function deleteAction(Request $request)
    {
        $id = (int)$request->get('id');

        if (! $id){
            throw new \InvalidArgumentException('"id" must be not empty numeric value');
        }

        /** @var ClassroomService $classroomService */
        $classroomService = $this->get('classroom.service');

        $classroomService->delete($id);
        $view = $this->view([], Response::HTTP_OK);

        return $this->handleView($view);
    }

    /**
     * Get classroom
     *
     * @ApiDoc(
     *     section="Classroom",
     *     authentication=false,
     *     parameters={
     *     },
     *     description="Get classroom",
     *     statusCodes={
     *         200="Returned when request is successful",
     *         400="Returned when bad request received",
     *         405="Returned when method not allowed"
     *    }
     *  )
     *
     * @param Request $request
     * @return Response
     *
     * @Get("/classroom/{id}", )
     */
    public function getAction(Request $request)
    {
        $id = (int)$request->get('id');

        if (! $id){
            throw new \InvalidArgumentException('"id" must be not empty numeric value');
        }

        /** @var ClassroomService $classroomService */
        $classroomService = $this->get('classroom.service');

        $classroom = $classroomService->getById($id);
        if (null == $classroom) {
            throw new \InvalidArgumentException(sprintf('Classroom with ID "%d" not exists', $id));
        }
        $view = $this->view($classroom, Response::HTTP_OK);

        return $this->handleView($view);
    }

    /**
     * Get classroom list
     *
     * @ApiDoc(
     *     section="Classroom",
     *     authentication=false,
     *     parameters={
     *     },
     *     description="Get classroom list",
     *     statusCodes={
     *         200="Returned when request is successful",
     *         400="Returned when bad request received",
     *         405="Returned when method not allowed"
     *    }
     *  )
     *
     * @param Request $request
     * @return Response
     *
     * @Get("/classrooms", )
     */
    public function listAction(Request $request)
    {
        /** @var ClassroomService $classroomService */
        $classroomService = $this->get('classroom.service');

        $classrooms = $classroomService->getList();
        $view = $this->view($classrooms);

        return $this->handleView($view);
    }
}
