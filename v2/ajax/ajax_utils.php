<?php

class AjaxUtils {
    /**
     * Esegue l'echo dei dati passati come risposta json.
     *
     * @param $data array|string Dati da restituire sotto forma di json
     */
    static function returnJsonHttpResponse($data){
        // remove any string that could create an invalid JSON
        // such as PHP Notice, Warning, logs...
        ob_clean();

        // this will clean up any previously added headers, to start clean
        header_remove();

        // Set the content type to JSON and charset
        // (charset can be set to something else)
        header("Content-type: application/json; charset=utf-8");

        // encode your PHP Object or Array into a JSON string.
        // stdClass or array
        $json = json_encode($data);
        if ($json === false) {
            // Avoid echo of empty string (which is invalid JSON), and
            // JSONify the error message instead:
            $json = json_encode(["jsonError" => json_last_error_msg()]);
            if ($json === false) {
                // This should not happen, but we go all the way now:
                $json = '{"jsonError":"unknown"}';
            }
            // Set HTTP response status code to: 500 - Internal Server Error
            http_response_code(500);
        } else {
            http_response_code(200);
        }
        echo $json;

        // making sure nothing is added
        exit();
    }
}