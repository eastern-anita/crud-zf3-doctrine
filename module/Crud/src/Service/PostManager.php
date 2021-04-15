<?php

declare(strict_types=1);

namespace Crud\Service;

use Crud\Entity\Post;
use Doctrine\ORM\EntityManager;

class PostManager
{
    /** @var EntityManager */
    private $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param array $data
     */
    public function addNewPost(array $data): void
    {
        // Create new Post entity.
        $emp = new Post();
        $emp->setTitle($data['title']);
        $emp->setDescription($data['description']);

        // Add the entity to entity manager.
        $this->entityManager->persist($emp);

        // Apply changes to database.
        $this->entityManager->flush();
    }

    /**
     * @param int $editId
     * @param array $data
     */
    public function editPost(int $editId, array $data): void
    {
        // Edit Post entity.
        $edit = $this->entityManager->getRepository(Post::class)->find($editId);

        $edit->setTitle($data['title']);
        $edit->setDescription($data['description']);

        $this->entityManager->persist($edit);
        $this->entityManager->flush();
    }

    /**
     * @param Post $del
     */
    public function deletePost(Post $del): void
    {
        $this->entityManager->remove($del);
        $this->entityManager->flush();
    }
}
