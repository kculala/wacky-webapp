<?php

/**
 * Dummy model class that represents the airports our airline services 
 */
class Airports extends CI_Model
{

    // The mock airport data
    var $data = array(
        'L_YPR' => array(
            'code' => 'YPR',
            'location' => 'Prince Rupert Airport'),
        'L_ZMT' => array(
            'code' => 'ZMT',
            'location' => 'Masset Airport'),
        'L_YZP' => array(
            'code' => 'YZP',
            'location' => 'Sandspit Airport'),
        'L_YXT' => array(
            'code' => 'YXT',
            'location' => 'Terrace Airport'),
    );

    // Constructor
    public function __construct()
    {
        parent::__construct();

        // inject each "record" key into the record itself, for ease of presentation
        foreach ($this->data as $key => $record)
        {
            $record['key'] = $key;
            $this->data[$key] = $record;
        }
    }

    // Get a single airplane based off its id, or null if not found
    public function get($which)
    {
        return !isset($this->data[$which]) ? null : $this->data[$which];
    }

    // Get all the airports
    public function all()
    {
        return $this->data;
    }

}