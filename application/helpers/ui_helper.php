<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');

    if (!function_exists('check_inputs')) {
        function check_inputs($inputs = array()) {
            for ($i = 0; $i < count($inputs); $i++) {
                $current_input = $inputs[$i];

                if (strlen(trim($current_input)) == 0) {
                    return false;
                }
            }

            return true;
        }
    }
?>