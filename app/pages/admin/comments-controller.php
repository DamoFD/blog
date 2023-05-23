<?php

    // Mark all emails as read
    if($action == 'mark-all'){

        // Check if form was submitted
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $query = "UPDATE emails SET seen = 1 WHERE seen = 0";

        query($query);
        redirect('admin/emails');
        }
    }elseif($action == 'read'){

        // Mark given email as read
        $query = "UPDATE emails SET seen = 1 WHERE id = :id AND seen = 0";

        query($query, ['id' => $id]);

        // If form submitted, delete email
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $query = "DELETE FROM emails WHERE id = :id LIMIT 1";

            query($query, ['id' => $id]);
            redirect('admin/emails');
        }
    }

?>