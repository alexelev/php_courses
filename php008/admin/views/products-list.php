<h1>Список товаров</h1>

<div>
    <a href="products.php?action=new">Добавить товар</a>
</div>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Картинка</th>
            <th>Название товара</th>
            <th>Категория</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Дата добавления</th>
        </tr>
    </thead>
    
    <tbody>
        <?php $pages_count = ceil(Product::getCount() / $per_page); ?>
        <?php foreach (Product::getAll($per_page, ($page - 1) * $per_page) as $product) { ?>
            <tr>
                <td><?= $product->id ?></td>
                <td><img src="/images/product/<?= $product->id ?>.jpg" style="width: 100px; height: 100px;"/></td>
                <td><?= $product->name ?></td>
                <td><?= $product->category_name ?></td>
                <td><?= $product->price ?></td>
                <td><?= $product->quantity ?></td>
                <td><?= $product->created ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<ul class="pagination">
    <?php for ($p = 1; $p <= $pages_count; $p++) { ?>
        <li><a href="products.php?page=<?= $p ?>"><?= $p ?></a></li>
    <?php } ?>
</ul>
