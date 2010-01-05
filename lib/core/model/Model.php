<?php
/**
 *  Short description.
 *
 *  @license   http://www.opensource.org/licenses/mit-license.php The MIT License
 *  @copyright Copyright 2008-2010, Spaghetti* Framework (http://spaghettiphp.org/)
 */

class Model {
    /**
      *  Short description.
      */
    public $aliasAttribute = array();
    /**
      *  Short description.
      */
    public $blacklist = array();
    /**
      *  Short description.
      */
    public $getters = array();
    /**
      *  Short description.
      */
    protected $resultSet = array();
    /**
      *  Short description.
      */
    public $setters = array();
    /**
      *  Short description.
      */
    public $whitelist = array();
    
    public $created = null;
    
    public function __construct($record = null) {
        if(is_null($record)):
            $this->created = true;
        elseif(is_array($record)):
            $this->setAttributes($record);
            $this->created = true;
        else:
            $this->created = false;
        endif;
    }
    /**
      *  Short description.
      *
      *  @throws Exception
      *  @param string $name
      *  @return mixed
      */
    public function __get($name) {
        $name = $this->alias($name);
        if(in_array($name, $this->getters)):
            $getter = 'get' . Inflector::camelize($name);
            return $this->{$getter}();
        elseif(array_key_exists($name, $this->resultSet)):
            return $this->resultSet[$name];
        endif;
        
        throw new Exception;
    }
    /**
      *  Short description.
      *
      *  @param string $name
      *  @param mixed $value
      *  @return mixed
      */
    public function __set($name, $value) {
        $name = $this->alias($name);
        if(in_array($name, $this->setters)):
            $setter = 'set' . Inflector::camelize($name);
            return $this->{$setter}($value);
        else:
            return $this->set($name, $value);
        endif;
    }
    /**
      *  Short description.
      *
      *  @param string $name
      *  @return string
      */
    protected function alias($name) {
        if(array_key_exists($name, $this->aliasAttribute)):
            $name = $this->aliasAttribute[$name];
        endif;
        
        return $name;
    }
    /**
      *  Short description.
      *
      *  @return void
      */
    public function create($record = null) {
        $class = get_class($this);
        return new $class($record);
    }
    /**
      *  Short description.
      *
      *  @param string $name
      *  @param mixed $value
      *  @return mixed
      */
    public function set($name, $value) {
        return $this->resultSet[$name] = $value;
    }
    /**
      *  Short description.
      *
      *  @param array $attributes
      *  @return object
      */
    public function setAttributes(array $attributes) {
        $blacklist = !empty($this->blacklist);
        $whitelist = !empty($this->whitelist);
        foreach($attributes as $name => $value):
            $protected = (
                $blacklist && in_array($name, $this->blacklist) or
                $whitelist && !in_array($name, $this->whitelist)
            );
            if(!$protected):
                $this->{$name} = $value;
            endif;
        endforeach;
        
        return $this;
    }
}