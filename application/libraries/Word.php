<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * CodeIgniter DomPDF Library
 *
 * Generate PDF's from HTML in CodeIgniter
 *
 * @packge        CodeIgniter
 * @subpackage        Libraries
 * @category        Libraries
 * @author        Ardianta Pargo
 * @license        MIT License
 * @link        https://github.com/ardianta/codeigniter-dompdf
 */

use PhpOffice\PhpWord\PhpWord;
class Word extends PhpWord{
    /**
     * PDF filename
     * @var String
     */
    public $filename;
    public $templ;
    public $data;
    public $cloneRow;
    public function __construct(){
        parent::__construct();
        $this->filename = "laporan.pdf";
    }
    /**
     * Get an instance of CodeIgniter
     *
     * @access    protected
     * @return    void
     */
    protected function ci()
    {
        return get_instance();
    }
    /**
     * Load a CodeIgniter view into domPDF
     *
     * @access    public
     * @param    string    $view The view to load
     * @param    array    $data The view data
     * @return    void
     */
    public function load_template(){
        $document = $this->loadTemplate($this->templ);
        foreach($this->data as $key => $val){
            $document->setValue($key,$val);
        }
		// $values = [
        //     ['userId' => 1, 'konten' => 'Batman', 'userAddress' => 'Gotham City'],
        //     ['userId' => 2, 'konten' => 'Superman', 'userAddress' => 'Metropolis'],
        // ];
        // $document->cloneRowAndSetValues('konten', $values);
        if(!empty($this->cloneRow)){
            foreach($this->cloneRow as $key => $val){
                $document->cloneRowAndSetValues($key, $val);
            }
        }
		
        $document->saveAs($this->filename);
		
		header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.$this->filename);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($this->filename));
        flush();
        readfile($this->filename);
        unlink($this->filename);
        exit;        
    }
}