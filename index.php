<?php 
if ($maintenance_mode == 1) {
  require 'outofservice.php';
  exit(0);
}
include 'lib.php';
session_start();
print_header("Home");
?>
<div class="grid_10 prefix_1 suffix_1">
<div id="gatherling_main" class="box">
<div class="alpha omega grid_10 uppertitle">Gatherling</div>
<div class="clear"></div>
<p>Welcome to Gatherling!  This is an application where you can keep track of
your decks in order to see what you played last tourney, last month, or even
last year.  You can keep track of all of your decks which are played in 
<?php echo $CONFIG['site_name']; ?>
 tournaments here, and your ratings for Pauper Magic will also be calculated.</p>
<p>
<div class="alpha grid_5">
<b>Some good starting points:</b>
<ul>
<li> <a href="eventreport.php"> See a list of recent events </a> </li>
<li> <a href="decksearch.php"> Search for decks with a certain card </a> </li>
<ul>
<b>Random statistics about Gatherling:</b>
<ul>
<li> There are <?php echo Deck::uniqueCount() ?> unique decks. </li>
<li> We have recorded <?php echo Match::count() ?> matches from <?php echo Event::count() ?> events.</li>
<li> There are <?php echo Player::activeCount() ?> active players in gatherling. (<?php echo Player::verifiedCount() ?> verified) </li>
</ul>
</div>
<div class="grid_5 omega">
<?php $player = Player::getSessionPlayer(); ?>
<?php if ($player != NULL): ?>
<b> Welcome back <?php echo $player->name ?> </b>
<ul>
<li> <a href="profile.php">Check out your profile</a> </li>
<li> <a href="player.php?mode=alldecks">Enter your own decklists</a> </li>
<?php $event = Event::findMostRecentByHost($player->name);
if (!is_null($event)) { ?>
<li> <a href="event.php?name=<?php echo $event->name ?>">Manage <?php echo $event->name ?></a> </li>
<?php } ?>
<?php if ($player->isHost()) { ?>
<li> <a href="event.php">Host Control Panel</a> </li>
<?php } ?>
</ul>
<?php else: ?>
<center> <b> Login to Gatherling </b> </center>
<form action="login.php" method="post">
  <table class="form" align="center" style="border-width: 0px" cellpadding="3">
    <tr>
      <th>MTGO Username</th>
      <td><input type="text" name="username" value="" /></td>
    </tr>
    <tr>
      <th>Gatherling Password</td>
      <td><input type="password" name="password" value="" /></td>
    </tr>
    <tr>
      <td colspan="2" class="buttons">
        <input type="submit" name="mode" value="Log In" /> <br />
        <a href="register.php">Need to register?</a>
      </td>
    </tr>
  </table>
</form>
<?php endif; ?>
</div> <!-- grid_5 omega (login/links) -->

<div class="clear"></div>
</div> <!-- gatherlingmain box -->

<div class="box" id="gatherling_news">
<div class="uppertitle alpha omega grid_10"> Latest Gatherling News </div>
<div class="clear"></div>
<?php require_once 'news.php'; ?>
<div class="clear"></div>
</div> <!-- box gatherlingnews -->
</div> <!-- grid 10 pre 1 suff 1-->

<?php print_footer(); ?>

</div>  <!-- container -->
</body>
</html>
