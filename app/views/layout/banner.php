<div class="container mt-5">
<header class="d-flex justify-content-between align-items-center pb-3 border-bottom mb-4">
    <?php if ($page === 'home'): ?>
        <h1 class="mb-0">Product List</h1>
        <div>
            <a href="<?php echo htmlspecialchars(BASE_URL . '/add-product'); ?>" id="add" class="btn btn-primary me-2">ADD</a>
            <form id="delete-form" action="/assignmenttest/public/delete" method="POST" class="d-inline">
                <button id="delete-product-btn" type="submit" class="btn btn-danger">MASS DELETE</button>
        </div>
        <?php elseif ($page === 'add'): ?>
        <h1 class="mb-0">Add Product</h1>
        <div>
        <form id="product-form" action="/assignmenttest/public/save" method="POST" class="d-inline">
            <button type="submit" class="btn btn-primary me-2">Save</button>
            <a href="/assignmenttest/public/" class="btn btn-secondary">Cancel</a>
        </div>
    <?php endif; ?>
</header>
</div>
