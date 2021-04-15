<?php

declare(strict_types=1);

namespace Crud\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Crud\Entity\Post;
use Crud\Form\EditForm;
use Crud\Form\AddForm;
use Crud\Service\PostManager;
use Doctrine\ORM\EntityManager;

class CrudController extends AbstractActionController
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var PostManager
     */
    private $postManager;

    /**
     * @param EntityManager $entityManager
     * @param PostManager $postManager
     */
    public function __construct(EntityManager $entityManager, PostManager $postManager)
    {
        $this->entityManager = $entityManager;
        $this->postManager = $postManager;
    }

    public function indexAction()
    {
        $post = $this->entityManager->getRepository(Post::class)->findAll();
        return new ViewModel(['post' => $post]);
    }

    public function addAction()
    {
        // Create the form.
        $form = new AddForm();

        // Check whether this post is a POST request.
        if ($this->getRequest()->isPost()) {

            // Get POST data.
            $data = $this->params()->fromPost();

            // Fill form with data.
            $form->setData($data);
            if ($form->isValid()) {

                // Get validated form data.
                $data = $form->getData();
            }

            // Use crud service to add new post to database.
            $this->postManager->addNewPost($data);

            return $this->redirect()->toRoute('crud');
        }

        return new ViewModel([
            'form' => $form
        ]);
    }

    public function editAction()
    {
        // Create the form.
        $form = new EditForm();

        // Get ID.
        $valId = $this->params()->fromRoute('id');

        // Find existing Id from database.
        $value = $this->entityManager->getRepository(Post::class)->find($valId);

        $form->get('title')->setValue($value->getTitle());
        $form->get('description')->setValue($value->getDescription());

        // Check whether this post is a POST request.
        if ($this->getRequest()->isPost()) {

            // Get POST data.
            $data = $this->params()->fromPost();

            // Fill form with data.
            $form->setData($data);

            if($form->isValid()) {

                // Get validated form data.
                $data = $form->getData();
            }

            $editId = $this->params()->fromRoute('id');

            // Use crud service to edit post.
            $this->postManager->editPost((int) $editId, $data);

            // Redirect the user to crud url
            return $this->redirect()->toRoute('crud');
        }

        // Render the view template.
        return new ViewModel([
            'form' => $form
        ]);
    }

    public function deleteAction()
    {
        // Get delete ID.
        $delId = $this->params()->fromRoute('id');

        // Find existing id in the database.
        $del = $this->entityManager->getRepository(Post::class)->find($delId);

        if ($del == null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        // Use crud service to del post.
        $this->postManager->deletePost($del);

        // Redirect the user to "index" page.
        return $this->redirect()->toRoute('crud');
    }
}
