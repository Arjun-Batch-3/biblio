<?php
    session_start();

    if (!empty($_GET)) {
        if (isset($_GET['coverDesignReqId'])){
            $coverDesignReqId = $_GET['coverDesignReqId'];
            $_SESSION['coverDesignReqId'] = $coverDesignReqId;
            header("location: ../paint");
            exit();
        }
    }
?>
