<?php
session_start();

echo "Logout Successfully ";
session_destroy();   // function that Destroys Session 

?>
<!-- header("Location: ./../../index.php"); -->
<script type="text/javascript">
    window.location.href = "./../../index.php";
</script>