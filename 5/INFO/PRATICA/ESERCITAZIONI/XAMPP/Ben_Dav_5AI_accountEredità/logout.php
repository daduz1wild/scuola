<?php
# Benedetti Davide     5AI     12/01/2025     logout.php

    session_start();
    session_destroy();
    header("Location: index.php");
?>