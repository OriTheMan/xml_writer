<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Xml extends CI_Controller
{

    function __construct ()
    {
        parent::__construct();
    }

    function index ()
    {
        
        // Load XML writer library
        $this->load->library('xml_writer');
        
        // Initiate class
        $xml = new Xml_writer();
        $xml->setRootName('my_store');
        $xml->initiate();
        
        // Start branch 1
        $xml->startBranch('cars');
        
        // Set branch 1-1 and its nodes
        $xml->startBranch('car', array('country' => 'usa')); // start branch 1-1
        $xml->addNode('make', 'Ford');
        $xml->addNode('model', 'T-Ford', array(), true);
        $xml->endBranch();
        
        // Set branch 1-2 and its nodes
        $xml->startBranch('car', array('country' => 'Japan')); // start branch
        $xml->addNode('make', 'Toyota');
        $xml->addNode('model', 'Corolla', array(), true);
        $xml->endBranch();
        
        // End branch 1
        $xml->endBranch();
        
        // Start branch 2
        $xml->startBranch('bikes'); // start branch
        

        // Set branch 2-1  and its nodes
        $xml->startBranch('bike', array('country' => 'usa')); // start branch
        $xml->addNode('make', 'Harley-Davidson');
        $xml->addNode('model', 'Soft tail', array(), true);
        $xml->endBranch();
        
        // End branch 2
        $xml->endBranch();
        
        // Pass the XML to the view
        $data = array();
        $data['xml'] = $xml->getXml(FALSE);
        $this->load->view('xml', $data);
    }
}
