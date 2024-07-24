<?php

namespace App\Documents;

use Illuminate\Support\Facades\App;
use ZipArchive;

/**
 * Abstraction for document generation.
 * Used to generate document into different file formats.
 */
abstract class Document
{
    public const PDF = 'pdf';
    public const XLSX = 'xlsx';
    public const HTML = 'html';

    /**
     * The instance of the generator
     */
    private $generator;

    /**
     * The Laravel Excel exporter class name.
     *
     * @var string
     */
    public $excelExporter;

    /**
     * The view that will be used to layout the document.
     * This will be the name of the blade file.
     *
     * @var string
     */
    public $view = 'documents.base';

    /**
     * The title of the document.
     */
    public $title = '';

    /**
     * Sets the size of the document.
     *
     * @var string
     */
    public $size = 'a4';

    /**
     * Name of the file.
     *
     * @var string
     */
    public $filename = '';

    /**
     * Prepares the document and configure its settings.
     *
     * @return void
     */
    public function __construct()
    {
        $this->generator = (App::make('dompdf.wrapper'))
            ->setPaper($this->size);
    }

    /**
     * Method what will prepare the data and insert it
     * to the specified view and returns the html.
     *
     * @return string
     */
    abstract public function prepare();

    /**
     * Renders the data using the view specified.
     *
     * @return void
     */
    public function render()
    {
        $title = $this->title;
        $data = $this->prepare();

        /**
         * Renders the data with the view.
         */
        $this->generator->loadView($this->view, compact('data', 'title'));
    }

    /**
     * Generate the document to a pdf file.
     *
     * @return void
     */
    public function toPdf()
    {
        $this->render();

        return $this->generator->download();
    }

    /**
     * Generate the document to a spreadsheet file.
     *
     * @return void
     */
    public function toExcel()
    {
        //
    }

    /**
     * Generate the document to html.
     *
     * @return void
     */
    public function toHtml()
    {
        $title = $this->title;
        $data = $this->prepare();

        return view($this->view, compact('data', 'title'))->render();
    }

    /**
     * Returns the specified format. This is just an
     * alternative approach on generating documents.
     *
     * @param string $format
     * @return string
     */
    public function generate($format = 'pdf')
    {
        if ($format === self::XLSX) {
            return $this->toExcel();
        }

        if ($format === self::HTML) {
            return $this->toHtml();
        }

        return $this->toPdf();
    }

    /**
     * Returns all the formats into a compressed
     * file.
     *
     * @return void
     */
    public function all()
    {
        $zip = new ZipArchive;

        $zip->addFile($this->toPdf());
        $zip->addFile($this->toExcel());
        $zip->addFile($this->toHtml());
    }
}
