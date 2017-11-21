
<?php
if(!isset($_SESSION['user_id']))
{
      header('Location: ?page=check');
}
else
{
        $message = 'welkom '. $_SESSION['username'];
    }
 ?>
 <nav class="navigation2">
         <ul>
           <li><img src="images/logo.png" alt="brainLogo" id="logoImage2"></li>
           <li><?php echo $message . ' ' . '<a href="?page=logout"><i class="fa fa-sign-out" aria-hidden="true" id="smallerFont"></i></a>'; ?></li>
         </ul>
       </nav>
