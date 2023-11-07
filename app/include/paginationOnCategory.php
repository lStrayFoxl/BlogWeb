<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item"><a class="page-link" href="<?=BASE_URL . '/category.php?page=1&id=' . $id;?>">First</a></li>

        <?php if($page > 1): ?>
            <li class="page-item"><a class="page-link" href="<?=BASE_URL . '/category.php?page=' . $page - 1 . '&id=' . $id;?>">Previous</a></li>
        <?php endif; ?>
        
        <?php if($page < $total_pages && $total_pages != ($page * 2)): ?>
            <li class="page-item"><a class="page-link" href="<?=BASE_URL . '/category.php?page=' . $page + 1 . '&id=' . $id;?>">Next</a></li>
        <?php endif; ?>

        <li class="page-item"><a class="page-link" href="<?=BASE_URL . '/category.php?page='. $total_pages / 2 .'&id=' . $id;?>">Last</a></li>
    </ul>
</nav>