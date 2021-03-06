<?php

require_once '../lib.php';

if (strncmp($_SERVER['HTTP_USER_AGENT'], 'infobot', 7) != 0) {
    die("<error>You're not infobot!</error>");
}

if ($_GET['passkey'] != $CONFIG['infobot_passkey']) {
    die('<error>Wrong passkey</error>');
}

// generate a user passkey for verification
$random_num = mt_rand();
$key = sha1($random_num);
$challenge = substr($key, 0, 5);
$player = Player::findByName($_GET['username']);
if (!$player) {
    echo "<UaReply>You're not registered on {$CONFIG['site_name']}!</UaReply>";

    return;
}

if (strncmp($_REQUEST['action'], 'verify') == 0) {
    $player->setChallenge($challenge);
    echo "<UaReply>Your verification code for {$CONFIG['site_name']} is $challenge</UaReply>";
} elseif (strncmp($_REQUEST['action'], 'reset') == 0) {
    $player->setPassword($challenge);
    echo "<UaReply>Your temporary password for {$CONFIG['site_name']} is $challenge</UaReply>";
} else {
    echo '<error>Unknown Action</error>';
}
