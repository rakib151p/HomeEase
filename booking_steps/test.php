
<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>
<?php
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>'; 
echo "<script>
    Swal.fire({
        icon: 'warning',
        title: 'Not available',
        text: 'This service is not available now.',
        confirmButtonText: 'OK'
    }).then(() => {
        window.location.href = 'index.php';
    });
</script>";

?>
</body>
</html>
