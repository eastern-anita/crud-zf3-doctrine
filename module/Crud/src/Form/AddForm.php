<?php

declare(strict_types=1);

namespace Crud\Form;

use Zend\Form\Form;

class AddForm extends Form
{
    public function __construct()
    {
        // Define form name
        parent::__construct('post-form');

        // Set POST method for this form
        $this->setAttribute('method', 'post');

        // Add form elements
        $this->addElements();
    }

    /**
     * This method adds elements to form (input fields and submit button).
     */
    private function addElements()
    {
        // Add "title" field
        $this->add([
            'type'  => 'text',
            'name' => 'title',
            'attributes' => [
                'id' => 'title'
            ],
            'options' => [
                'label' => 'Title',
            ],
        ]);

        // Add "description" field
        $this->add([
            'type'  => 'text',
            'name' => 'description',
            'attributes' => [
                'id' => 'description'
            ],
            'options' => [
                'label' => 'Description',
            ],
        ]);

        // Add the submit button
        $this->add([
            'type'  => 'submit',
            'name' => 'submit',
            'attributes' => [
                'value' => 'Submit',
            ],
        ]);
    }
}
