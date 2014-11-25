<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ExpressionEngine - by EllisLab
 *
 * @package     ExpressionEngine
 * @author      ExpressionEngine Dev Team
 * @copyright   Copyright (c) 2003 - 2014, EllisLab, Inc.
 * @license     http://expressionengine.com/user_guide/license.html
 * @link        http://expressionengine.com
 * @since       Version 2.0
 * @filesource
 */

/**
 * Freeform Count Module Front End File
 *
 * @package    ExpressionEngine
 * @subpackage Addons
 * @category   Module
 * @author     Bjørn Børresen
 * @link       http://wedoaddons.com
 */
class Freeform_count
{
    public $return_data;

    /**
    * Constructor
    */
    public function __construct()
    {
        $this->return_data = $this->count();
    }

    /**
     * {exp:freeform_count collection=""}
     */
    public function count()
    {
        ee()->load->add_package_path(PATH_THIRD.'/freeform');
        ee()->load->model('freeform_entry_model');

        $form_id = ee()->TMPL->fetch_param('form_id');

        if(!$form_id) {

            $possible_label = ee()->TMPL->fetch_param('form_label');
            if (!$possible_label) {
                $possible_label = ee()->TMPL->fetch_param('collection');
            }

            ee()->load->model('freeform_form_model');

            $possible_id =	ee()->freeform_form_model
                ->select('form_id')
                ->get_row(array('form_label' => $possible_label));

            if ($possible_id !== FALSE)
            {
                $form_id = $possible_id['form_id'];
            }
        }

        $vars = array();
        if($form_id) {
            $count = ee()->freeform_entry_model
                ->id($form_id)
                ->where('complete', 'y')
                ->count();

            $vars[] = array('count' => $count);
        }

        return ee()->TMPL->parse_variables(ee()->TMPL->tagdata, $vars);
    }

}
/* End of file mod.freeform_count.php */
/* Location: /system/expressionengine/third_party/freeform_count/mod.freeform_count.php */