<?php declare(strict_types = 1);
/**
 * Functions
 *
*/
function app_location($uri = "") {
    header('Location:' . $uri);
    exit();
}


// function app_error_500(string $error = "", int $error_code = 500){
//     // TODO: I have to transform all the error app_error_500 to app_error and delete
//     echo $GLOBALS['twig']->render('nnl_500.html', ['error' => $error, ['error_code'] => $error_code]);
//     exit();
// }


function app_error(string $error = "Why not try refreshing your page? or you can contact ", int $error_code = 500){
    echo $GLOBALS['twig']->render('gsk_500.html', ['error' => $error, 'error_code' => $error_code]);
    exit();
}


function app_log_error( string $msg ) : void 
{
    /**
     * Log errors to the log file
     * @return void
     */

	file_put_contents( '../error.log', "\n" . $msg, FILE_APPEND | LOCK_EX);
}

function app_success(string $msg = "Congratulations, your account has been successfully created."){
    echo $GLOBALS['twig']->render('gsk_success.html', ['msg' => $msg]);
    exit();
}

/**
 * Clean data input
 */
function app_clean_input(string $str): string
    {
        $str = stripcslashes( strip_tags( $str ));
        return trim(htmlentities( $str ));
    }

    /**
     * Check the players data submitted and compare it with what we require
     */
    function app_is_data_complete(array $source, array $properties){
        $result = array();
        foreach ($properties as $data) {
            if(false === array_key_exists($data, $source)){
                app_error("$data not provided");
            }
            $result = array_merge($result, array($data => $source[$data] ));
        }
        return $result;
    }

    /**
     * Extract the inputed array of data into a new array after cleaning it up 
     */
    function app_clean_user_data(array $player_data){
        $player = [];
        foreach ($player_data as $data => $value) {
            $value = app_clean_input($value);
            $player = array_merge($player, array($data => $value));
        }
        return $player;
    }

/**
 * This is going to arrang an array for input database
 */

function app_prepare_insert_value(array $insert_value): string{
    $v = "";
    foreach ($insert_value as $key => $value) {
        $v = "$v'$value', ";
    }
    $v = trim($v);

    return rtrim($v, ',');
}

function app_upload_img($target_file, $upload_dir){
    $file_name = $_FILES[$target_file]['name']; 
    $extension =  pathinfo($file_name, PATHINFO_EXTENSION);
    $new_name = 'nnl_pix_'.time().'.'.$extension;
    $img_temone        = $_FILES[$target_file]['tmp_name'];
    move_uploaded_file($img_temone,"static/uploads/$upload_dir/$new_name");
    return $new_name;
}

