<?php
    function showMessageAndAbort($message, $abortExecution){
        echo $message;
        if ($abortExecution == true)
            exit;
    }

    function showMessage($message){
        showMessageAndAbort($message, false);
    }

    function showMessageFormatedAndAbort($message){
        showMessageAndAbort("<center><h3>" . $message . "</h3></center>", true);
    }

    function showMessageFormated($message){
        showMessageAndAbort("<center><h3>" . $message . "</h3></center>", false);
    }
?>