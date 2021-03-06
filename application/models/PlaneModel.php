<?php

require_once(APPPATH.'models/WackyModel.php');

/*
* Plane entity class
*/
class PlaneModel extends CI_Model {

    /*
    * ctor
    */
    public function __construct($id = 'Kid', $code ='')
    {
        parent::__construct();
        $this->id = $id;
        $this->airplaneCode = $code;
    }

    // If this class has a setProp method, use it, else modify the property directly
    public function __set($key, $value)
    {
        // if a set* method exists for this key,
        // use that method to insert this value.
        // For instance, setName(...) will be invoked by $object->name = ...
        // and setLastName(...) for $object->last_name =
        $method = 'set' . str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $key)));
        if (method_exists($this, $method))
        {
                $this->$method($value);
                return $this;
        }

        // Otherwise, just set the property value directly.
        $this->$key = $value;
        return $this;
    }

    /*
    * Setter for plane unique Id
    * param $value - String representing the plane's unique id.
    * An Id will be considered invalid and throws and exception if:
    *   - The Id contains non-alphanumeric characters
    *   - The Id is an empty String
    *   - The Id does not start with 'k' or 'K'
    */
    public function setId(String $value)
    {
        if (!ctype_alnum($value)) {
            throw new Exception("Airplane ID must be Alphanumeric");
        }

        if (strlen($value) === 0) {
            throw new Exception("Airplane can not be empty");
        }

        if($value[0] != 'k' && $value[0] != 'K') {
            throw new Exception("Airplane ID must start with 'k' or 'K'");
        }

        $this->id = $value;
    }

    /*
    * Setter for plane airplaneCode. Used to retrieve the rest of the plane
    * info from the wacky server.
    * param $value - String representing the plane's airplane Code.
    * An Airplane Code will be considered invalid and throws and exception if:
    *   - The Airplane code does not exist on the wacky server.
    */
    public function setAirplaneCode(String $value)
    {
        $wackyModel = new WackyModel();
        $plane = $wackyModel->getAirplane($value);
        if(!$plane || $plane === 'null') {
            throw new Exception("Airplane Code not found: " . $value);
        }
        $this->airplaneCode = $value;
    }

    /**
     * Creates a plane model
     */
    public function create($id = 'kId', $ac = '')
    {
        return new PlaneModel($id, $ac);
    }

    /*
    * Getter for id.
    */
    public function getId()
    {
        return $this->id;
    }

    /*
    * Getter for airplane code.
    */
    public function getAirplaneCode()
    {
        return $this->airplaneCode;
    }

    /*
    * Getter for manufacturer.
    */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /*
    * Getter for model.
    */
    public function getModel()
    {
        return $this->model;
    }

    /*
    * Getter for price.
    */
    public function getPrice()
    {
        return $this->price;
    }

    /*
    * Getter for seats.
    */
    public function getSeats()
    {
        return $this->seats;
    }

    /*
    * Getter for reach.
    */
    public function getReach()
    {
        return $this->reach;
    }

    /*
    * Getter for cruise.
    */
    public function getCruise()
    {
        return $this->cruise;
    }

    /*
    * Getter for takeoff.
    */
    public function getTakeoff()
    {
        return $this->takeoff;
    }

    /*
    * Getter for hours.
    */
    public function getHourly()
    {
        return $this->hourly;
    }
}
