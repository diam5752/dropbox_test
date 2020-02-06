
<?php

        define("BEARER_TOKEN", "sl.AT_VhxfdFcO6YhQx2CWfF6D7mxjxANPFaDvAvc3Qjm35u9aA5qqKsHmGiYw-Gcq-3SOdJw45XZg7mbsqEej73G8sfe8vJBKjjGYmmPkCaPuuz6rmy7WfHkEY2zB0P4dT2x8fmv0J");

        // implements requests that has to do with folders using Curl
        function folder_request( $folder, $request) {

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $request);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"path\":\"$folder\"}");
    
            $headers = array();
            $headers[] = 'Authorization: Bearer ' . BEARER_TOKEN;
            $headers[] = 'Content-Type: application/json';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                $error = 'Error:' . curl_error($ch);
                return $error;
            }
            curl_close($ch);

            return $result;
        }



        //use this request to create folder 
        $create_folder_request = "https://api.dropboxapi.com/2/files/create_folder_v2";

        //use this request to list folder  
        $list_folder_request = "https://api.dropboxapi.com/2/files/list_folder";

        /*
        *   The following request creates a folder. Name of the folder is given in the $folder variable.
        */
        $folder = "/test";
        $result = folder_request( $folder, $create_folder_request);
        print_r($result);


        /*
        *   The following request lists a folder. When $folder is empty , it lists all the folders . 
        */
        $folder = "";  // $folder = "/test" if you want to list  only the folder created above.
        $result = folder_request( $folder, $list_folder_request);
        print_r($result);
        
?>