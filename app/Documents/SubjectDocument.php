<?php

namespace App\Documents;

use App\Models\Subject;

class SubjectDocument extends Document
{
    /**
     * The view that will be used to layout the document.
     * This will be the name of the blade file.
     *
     * @var string
     */
    public $view = 'documents.subject-details';

    /**
     * The title of the document.
     *
     * @var string
     */
    public $title = 'Subject Details';

    /**
     * Name of the file.
     *
     * @var string
     */
    public $filename = 'subject-details';

    /**
     * The subject model.
     *
     * @var Subject
     */
    public $subject;

    /**
     * Constructor method.
     *
     * @param Subject $subject
     */
    public function __construct(Subject $subject)
    {
        parent::__construct();

        $this->subject = $subject;
    }

    /**
     * Load and prepare the data.
     *
     * @return Subject
     */
    public function prepare()
    {
        return $this->loadData();
    }

    /**
     * Load the necessary data for the document.
     *
     * @return Subject
     */
    protected function loadData()
    {
        return $this->subject->load(['topics', 'creator']);
    }
}
