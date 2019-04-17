<?php
    require_once("vendor/autoload.php");

    const TYPE_MESSAGE_WARN  = "AVISO";
    const TYPE_MESSAGE_ERROR = "ERRO";

    use Rain\Tpl;

    // config
    $config = array(
        "tpl_dir"       => "template/",
        "cache_dir"     => "cache/",
        "debug"         => true, // set to false to improve the speed
    );

    Tpl::configure( $config );
    // Add PathReplace plugin (necessary to load the CSS with path replace)
    Tpl::registerPlugin( new Tpl\Plugin\PathReplace() );

    // create the Tpl object
    $tpl = new Tpl;

    function messageAlert($message){
        messageBox(TYPE_MESSAGE_WARN, $message);
    }
    
    function messageError($message){
        messageBox(TYPE_MESSAGE_ERROR, $message);
    }

    function messageBox($caption, $message){
        global $tpl;
                
        $tpl->assign("caption", $caption);
        $tpl->assign("text", $message);
        $tpl->assign("alert", ($caption == TYPE_MESSAGE_ERROR) ? "alert-danger" : "alert-success");

        $tpl->draw("result");
    }
?>
