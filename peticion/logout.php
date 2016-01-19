<?php
session_start();
// Borramos toda la sesion
session_destroy();

echo('<script>location.href="../"</script>');

?>


