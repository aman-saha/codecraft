<?php
//validation of name
        function valid_name($name)                 
        {
            global $error_in_name;
            if (!preg_match("/^[a-zA-Z ]*$/",$name)) 
            {
                $error_in_name = "Only letters and white space allowed";
                 return 0; 
            }
               
            else
                return 1;
        }
//validation of name

//validation of e-mail
        function valid_email($email)                
        {
            global $error_in_email;
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
            {
              return 0;
            }
            return 1;
        }
//validation of e-mail

//validation of phone number
        function valid_mobile($phoneNumber)
        {
            global $error_in_mobile;
            if(!empty($phoneNumber)) 
            {
                if(preg_match('/^\d{10}$/',$phoneNumber))
                {
                  return 1;
                }
                else
                {
                  $error_in_mobile = 'Phone number invalid !';
                  return 0;
                }
            }
            else
            {
              $error_in_mobile = 'You must provide a phone number !';
              return 0;
            }   
        }

//------------------------------------------------------------------------------------------------------------------------------------------------//

//preventing HTML and SQL Injection
        function mysql_entities_fix_string($data)
        {
            // Fix &entity\n;
            $data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
            $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
            $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
            $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

            // Remove any attribute starting with "on" or xmlns
            $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

            // Remove javascript: and vbscript: protocols
            $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
            $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
            $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

            // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
            $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
            $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
            $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

            // Remove namespaced elements (we do not need them)
            $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

            do
            {
                // Remove really unwanted tags
                $old_data = $data;
                $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
            }
            while ($old_data !== $data);
            $data = trim($data);
            $data = stripslashes($data);
            $data=htmlspecialchars($data);
            return $data;
        }

//------------------------------------------------------------------------------------------------------------------------------------------------//

        //to redirect to a new location
        function redirect_to($new_location) 
        {
            header("Location: " . $new_location);
            exit; 
        }
?>