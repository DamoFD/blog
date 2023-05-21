<nav>
        <ul>
            <li>
                <a class="<?=$section == 'dashboard' ? 'active' : ''?>" href="<?php echo ROOT; ?>/admin">Dashboard</a>
            </li>
            <li>
                <a href="<?=ROOT?>">Front-End</a>
            </li>
            <li>
            <a class="<?=$section == 'users' ? 'active' : ''?>" href="<?php echo ROOT; ?>/admin/users">Users</a>
            </li>
            <li>
            <a class="<?=$section == 'categories' ? 'active' : ''?>" href="<?php echo ROOT; ?>/admin/categories">Categories</a>
            </li>
            <li>
            <a class="<?=$section == 'posts' ? 'active' : ''?>" href="<?php echo ROOT; ?>/admin/posts">Posts</a>
            </li>
        </ul>
    </nav>
    <a href="<?php echo ROOT; ?>/logout">Sign Out</a>