<?php

    // Mark all comments as read
    if($action == 'mark-all'){

        // Check if form was submitted
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $query = "UPDATE comments SET seen = 1 WHERE seen = 0";

        query($query);
        redirect('admin/comments');
        }
    }elseif($action == 'read'){

        // Mark given comment as read
        $query = "UPDATE comments SET seen = 1 WHERE id = :id AND seen = 0";

        query($query, ['id' => $id]);

        // If form submitted, delete comment
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $query = "DELETE FROM comments WHERE id = :id LIMIT 1";

            query($query, ['id' => $id]);
            redirect('admin/comments');
        }
    }

?>