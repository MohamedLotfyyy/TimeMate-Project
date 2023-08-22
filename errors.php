<?php

function send_error($location, $message) {
    header("location:" . $location . "?error=" . urlencode($message));
}

?>