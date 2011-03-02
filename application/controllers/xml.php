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
        
        // Start branch 'cars'
        $xml->startBranch('cars');
        
        // Set children for branch 'cars'
        $xml->startBranch('car', array('country' => 'usa'));
        $xml->addNode('make', 'Ford');
        $xml->addNode('model', 'T-Ford', array(), true);
        $xml->endBranch();
        
        $xml->startBranch('car', array('country' => 'Japan'));
        $xml->addNode('make', 'Toyota');
        $xml->addNode('model', 'Corolla', array(), true);
        $xml->endBranch();
        
        // End branch 'cars'
        $xml->endBranch();
        
        // Start branch 'bikes'
        $xml->startBranch('bikes');
        
        // Set children for branch 'cars'
        // Code is indented to clarify relations.
        $xml->startBranch('bike', array('country' => 'usa'));
        $xml->addNode('make', 'Harley-Davidson');
        $xml->addNode('model', 'Soft tail', array(), true);
            $xml->startBranch('parts');
                $xml->startBranch('part', array('type' => 'exhaust'));
                $xml->addNode('id', '2323-012');
                $xml->endBranch();
                $xml->startBranch('part', array('type' => 'exhaust'));
                $xml->addNode('id', '2323-013');
                $xml->endBranch();
                $xml->startBranch('part', array('type' => 'carburator'));
                $xml->addNode('id', '2541-016');
                $xml->endBranch();
            $xml->endBranch();
        $xml->endBranch();
        
        $xml->startBranch('bike', array('country' => 'japan'));
        $xml->addNode('make', 'BMS');
        $xml->addNode('model', 'R75', array(), true);
        $xml->endBranch();
        
        // End branch 'bikes'
        $xml->endBranch();
        
        // Pass the XML to the view
        $data = array();
        $data['xml'] = $xml->getXml(FALSE);
        $this->load->view('xml', $data);
    }
}
