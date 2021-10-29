<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Array Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/array_helper.html
 */

// ------------------------------------------------------------------------

if ( ! function_exists('loadTemplateConfig'))
{

	function loadTemplateConfig($viewsConfig, $viewName, $data = '')
	{
		$ci =& get_instance();

		if( isset($viewsConfig[$viewName])){

			$vConfig = $viewsConfig[$viewName];

			if(isset($vConfig['body'])){
				$vConfig['body'] = $ci->load->view($vConfig['body'],$data,true);
			}


			if(!isset($vConfig['header'])){
				$vConfig['header'] = $ci->load->view($viewsConfig['header'],$data,true);
			}else{
				$vConfig['header'] = $ci->load->view($vConfig['header'],$data,true);
			}

			if(!isset($vConfig['footer'])){
				$vConfig['footer'] = $ci->load->view($viewsConfig['footer'],$data,true);
			}else{
				$vConfig['footer'] = $ci->load->view($vConfig['footer'],$data,true);
			}

			if(isset($vConfig['style'])){
				$styleLinks = "";
				if (is_array($vConfig['style'])) {

					foreach ($vConfig['style'] as $style) { 
						if(filter_var($style, FILTER_VALIDATE_URL)){
							$styleLinks .= '<link rel="stylesheet" href="'.$style.'"></link>';
						} else{
							$styleLinks .= '<link rel="stylesheet" href="'.base_url(CSS_RES.$style).'"></link>';
						}
						
						

					}
				} else {
					if(filter_var($vConfig['style'], FILTER_VALIDATE_URL)){
						$styleLinks .= '<link rel="stylesheet" href="'.$vConfig['style'].'"></link>';
					} else {
						$styleLinks .= '<link rel="stylesheet" href="'.base_url(CSS_RES.$vConfig['style']).'"></link>';

					}
				}

				$vConfig['style'] = $styleLinks;
			}

			
			if(isset($vConfig['script'])){
				$scriptTags = "";
				if (is_array($vConfig['script'])) {

					foreach ($vConfig['script'] as $script) { 
						if(filter_var($script, FILTER_VALIDATE_URL)){
							$scriptTags .= '<script type="text/javascript" src="'.$script.'"></script>';
						}else{
							$scriptTags .= '<script type="text/javascript" src="'.base_url(SCRIPT_RES.$script).'"></script>';
						}

					}
				} else {
					if(filter_var($vConfig['script'], FILTER_VALIDATE_URL)){
						$scriptTags .= '<script type="text/javascript" src="'.$vConfig['script'].'"></script>';
					} else {
						$scriptTags .= '<script type="text/javascript" src="'.base_url(SCRIPT_RES.$vConfig['script']).'"></script>';
					}
				}

				$vConfig['script'] = $scriptTags;
			}
			//var_dump($vConfig);die;
			return $vConfig;
		}
		return null;


	}
}


if(!function_exists('str_putcsv'))
{
    function str_putcsv($input, $delimiter = ',', $enclosure = '"')
    {
        // Open a memory "file" for read/write...
        $fp = fopen('php://temp', 'r+');
        // ... write the $input array to the "file" using fputcsv()...
        fputcsv($fp, $input, $delimiter, $enclosure);
        // ... rewind the "file" so we can read what we just wrote...
        rewind($fp);
        // ... read the entire line into a variable...
        $data = fread($fp, 1048576);
        // ... close the "file"...
        fclose($fp);
        // ... and return the $data to the caller, with the trailing newline from fgets() removed.
        return rtrim($data, "\n");
    }
 }
