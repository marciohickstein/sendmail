<?php
    function messageBox($caption, $message, $abortExecution){
        echo "<center>";
        echo "<div>";
        echo "<h2>$caption</h2><br>";
        echo "<h1>$message</h1>";
        echo "</div>";
        echo "</center>";
        if ($abortExecution == true)
            exit;
    }

    function messageBoxAndContinue($caption, $message){
        messageBox($caption, $message, false);
    }

    function messageBoxAndAbort($caption, $message){
        messageBox($caption, $message, true);
    }
?>