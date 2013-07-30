<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Plugin_Quizusers extends Plugin {

    /**
     * Item List
     * Usage:
     * 
     * {{ sample:items limit="5" order="asc" }}
     *      {{ id }} {{ name }} {{ slug }}
     * {{ /sample:items }}
     *
     * @return	array
     */
    function items() {
        $limit = $this->attribute('limit');
        $order = $this->attribute('order');

        return true;
    }

}

/* End of file plugin.php */