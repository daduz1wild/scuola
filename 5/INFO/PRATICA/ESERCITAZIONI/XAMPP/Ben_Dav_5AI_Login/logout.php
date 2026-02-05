<?php
# Benedetti Davide     5AI     19/12/2025     logout.php

    session_start();
    session_destroy();
    header("Location: index.php");
?>