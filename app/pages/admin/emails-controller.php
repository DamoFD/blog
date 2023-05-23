<?php

    // Mark all emails as read
    if($action == 'mark-all'){

        // Check if form was submitted
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $query = "UPDATE emails SET seen = 1 WHERE seen = 0";

        query($query);
        redirect('admin/emails');
        }
    }

?>