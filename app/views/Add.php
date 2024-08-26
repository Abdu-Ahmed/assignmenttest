<!DOCTYPE html>
<html lang="en">
<!-- Head Content -->
<?php
$title = "Add Product";
$scripts = ['../public/assets/js/TypeSwitcher.js'];
require_once 'layout/head.php';
?>
<body>
<div class="container mt-5">

    <!-- Banner/Header -->
     
    <?php require_once 'layout/banner.php'; ?>

          <!-- Error Message -->

          <?php if (!empty($message)): ?>
            <div class="alert alert-danger" role="alert">
                <?= htmlspecialchars($message) ?>
            </div>
            <?php endif; ?>

            <!-- common input fields -->

            <div class="mb-3">
                <label for="sku" class="form-label">SKU</label>
                <input type="text" class="form-control w-25" id="sku" name="sku" >
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control w-25" id="name" name="name" >
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control w-25" id="price" name="price">
            </div>
            <div class="mb-3">
                <label for="productType" class="form-label">Product Type</label>
                <select class="form-select w-25" id="productType" name="productType">
                    <option value="" data-fields="" selected>Select a product type</option>
                    <option value="DVD" data-fields="DVDField" >DVD</option>
                    <option value="Furniture" data-fields="FurnitureField">Furniture</option>
                    <option value="Book" data-fields="BookField" >Book</option>
                </select>
            </div>

            <!-- DVD input field -->

            <div id="DVDField" class="product-field">
            <label for="size" class="form-label">Please provide DVD Size:</label>
            <input type="text" class="form-control w-25" id="size" name="size" placeholder="Size (MB)" value="<?php echo htmlspecialchars($postData['size'] ?? ''); ?>">
            </div>

            <!-- Book input field -->

            <div id="BookField" class="product-field">
            <label for="weight" class="form-label">Please provide book weight:</label>
            <input type="text" class="form-control w-25" id="weight"    name="weight" placeholder="Weight (KG)" value="<?php echo htmlspecialchars($postData['weight'] ?? ''); ?>">
            </div>

            <!-- Furniture input fields -->

            <div id="FurnitureField" class="product-field">
            <label for="length" class="form-label">Please, provide furniture dimensions:</label>
            <input type="text" class="form-control w-25" id="height" name="height" placeholder="Height (CM)" value="<?php echo htmlspecialchars($postData['height'] ?? ''); ?>"><br>
            <input type="text" class="form-control w-25" id="width" name="width" placeholder="Width (CM)" value="<?php echo htmlspecialchars($postData['width'] ?? ''); ?>"><br>
            <input type="text" class="form-control w-25" id="length" name="length" placeholder="Length (CM)" value="<?php echo htmlspecialchars($postData['length'] ?? ''); ?>">
            </div>

          </form>
    </div>

    <!-- Footer -->

        <?php require_once 'layout/footer.php'; ?>

    <!-- Bootstrap JS -->
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>