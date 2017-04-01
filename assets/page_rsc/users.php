<?php
    require_once "load.php";
    global $lang;
    if(testConn() != "Success"){
      http_response_code(403);
      die();
    }
?>

<?php if(configItem('show_users') == "false"): ?>
    <h5 class='center-align'><i class='material-icons permission-denied'>highlight_off</i></h5>
    <p class='center-align permission-denied-text'><b><?= $lang['users']['permission_denied']; ?></b><br /><?= $lang['users']['permission_denied_sub']; ?></p>
<?php else: ?>

    <ul class="collapsible popout white-text" data-collapsible="accordian">
        
        <?php
            $user = new User(resumeConnection());
            $users = $user->fetchAll();

            foreach($users["data"] as &$val) {

                echo "<li>";
                echo '<div class="collapsible-header v0lture-dbs-header truncate"><i class="material-icons hide-on-med-and-down">account_circle</i>'.$val["User"].'</div>';

                echo '<div class="collapsible-body"><div class="collection">';
                echo '<p>There are currently no options available.</p>';
                echo '</div></div></li>';
            }
        ?>
        
    </ul>

<?php endif; ?>
