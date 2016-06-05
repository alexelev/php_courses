<div class="sidebar_box">
    <h3>Categories</h3>

    <div class="content">
        <ul class="sidebar_list">
            <?php foreach (Category::getAll() as $category) { ?>
                <li><a href="#<?= $category->id ?>"><?= $category->name ?></a></li>
            <?php } ?>
        </ul>
    </div>
</div>