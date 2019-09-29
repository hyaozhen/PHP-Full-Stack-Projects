<?php

$pass = password_hash("Hello World", PASSWORD_BCRYPT);
echo $pass;
/*
 * The above line prints, for example: $2y$10$hfd4bRj2w2shMdxVZc7MEu3uZoXU7CNUEmUhWCEJB11xO8vTc8ply
 * This line is of the format:   $2$random-salt$hashed-password
 * Note that the actual hash generated will be different if you run this, because of a different random salt.
 */
?>