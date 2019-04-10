<?php
    require_once("vendor/autoload.php");

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

    function messageBox($caption, $message){
        global $tpl;
        
        $tpl->assign("caption", $caption);
        $tpl->assign("text", $message);
        $tpl->draw("message");
    }
?>
