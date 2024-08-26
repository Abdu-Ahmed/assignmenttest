<!DOCTYPE html>
<html lang="en">

<!-- Head Content -->

<?php
$title = "Product List";
require_once 'layout/head.php';
?>

<body>

    <!-- Banner/Header -->

    <?php require_once 'layout/banner.php'; ?>
    

    <!-- Product Card -->

    <div class="container mt-5">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            
        <?php foreach ($products as $product): ?>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <input class="delete-checkbox form-check-input" type="checkbox" name="product_ids[]" value="<?php echo htmlspecialchars($product['id']); ?>">
                            <h5 class="card-title text-center"><?php echo htmlspecialchars($product['name']); ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted text-center">SKU: <?php echo htmlspecialchars($product['sku']); ?></h6>
                            <p class="card-text text-center"><?php echo htmlspecialchars($product['price']); ?>$</p>
                            <p class="card-text text-center"><?php echo $product['formatted_attributes']; ?></p>
                        </div>
                    </div>
                </div>
        <?php endforeach; ?>


        </div>
</form>  
    </div>

    <!-- Footer -->

        <?php require_once 'layout/footer.php'; ?>

    <!-- Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
