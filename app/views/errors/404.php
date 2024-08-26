<!DOCTYPE html>
<html lang="en">

<!-- Head Content -->

<?php
$title = "404 Not Found";
require_once __DIR__ . '/../layout/head.php';
?>
<body>
    <h1>404 Not Found</h1>
    <p>The page you are looking for does not exist.</p>
    <a href="<?= BASE_URL ?>">Go to Home</a>
</body>

    <!-- Footer -->

    <?php require_once __DIR__ . '/../layout/footer.php'; ?>

<!-- Bootstrap JS -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
