<?php

namespace ClassroomBundle\Services;

use ClassroomBundle\Entity\Classroom;
use ClassroomBundle\Repository\ClassroomRepository;

/**
 * Classroom Service
 */
class ClassroomService
{
    /**
     * @var ClassroomRepository
     */
    private $classroomRepository;

    public function __construct(ClassroomRepository $classroomRepository)
    {
        $this->classroomRepository = $classroomRepository;
    }

    /**
     * @return Classroom[]
     */
    public function getList(): array
    {
        return $this->classroomRepository->findAll();
    }

    /**
     * @param int $id
     * @return null|Classroom
     */
    public function getById(int $id)
    {
        /** @var Classroom|null $classroom */
        $classroom = $this->classroomRepository->find($id);

        return $classroom;
    }

    /**
     * @param $name
     * @return Classroom|null
     */
    public function getByName($name): ?Classroom
    {
        /** @var Classroom $classroom */
        $classroom = $this->classroomRepository->findOneBy(['name' => $name]);

        return $classroom;
    }

    /**
     * @param string $name
     * @param bool $isActive
     * @return Classroom
     */
    public function create(string $name, $isActive): Classroom
    {
        $classroom = $this->getByName($name);
        if (null !== $classroom) {
            throw new \InvalidArgumentException(sprintf('Classroom "%s" already exists', $name));
        }

        $classroom = new Classroom();
        $classroom->setName($name);
        $classroom->setIsActive($isActive);

        $this->save($classroom);

        return $classroom;
    }

    /**
     * @param int $id
     * @param string $name
     * @param bool $isActive
     * @return Classroom
     */
    public function edit(int $id, string $name, bool $isActive): Classroom
    {
        /** @var Classroom $classroom */
        $classroom = $this->getById($id);
        if (null == $classroom) {
            throw new \InvalidArgumentException(sprintf('Classroom with ID "%d" not exists', $id));
        }

        $classroom->setName($name);
        $classroom->setIsActive($isActive);

        $this->save($classroom);

        return $classroom;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        /** @var Classroom $classroom */
        $classroom = $this->classroomRepository->find($id);
        if (null == $classroom) {
            throw new \InvalidArgumentException(sprintf('Classroom with ID "%d" not exists', $id));
        }

        $this->classroomRepository->delete($classroom);

        return true;
    }

    /**
     * @param Classroom $classroom
     * @return Classroom
     */
    public function save(Classroom $classroom): Classroom
    {
        $this->classroomRepository->save($classroom);

        return $classroom;
    }
}