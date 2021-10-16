<div class="menu">
    <ul>
        <li>
            <?php if(isset($_SESSION['authorized']) && $_SESSION['authorized']==true) { 
						if($sec_level==9) { ?>
			        		<a href="../competition/competition_list.php" style="margin-left: 3px"><span>Admin</span></a>
             <?php } ?>
        		<a href="../login/logoff.php" style="margin-left: 3px"><span>Afmelden</span></a>
            <?php } else { ?>
        		<a href="../login/login.php" style="margin-left: 3px"><span>Aanmelden</span></a>
            <?php } ?>
        </li>
    </ul>
</div>