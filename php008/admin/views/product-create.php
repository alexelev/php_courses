<div class="row">
    <div class="col-sm-4 col-sm-offset-4">
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Название товара</label>
                <input type="text" name="name" class="form-control"/>
            </div>

            <div class="form-group">
                <label>Картинка</label>
                <input type="file" name="image" class="form-control" accept="image/png, image/jpg, image/jpeg, image/bmp"/>
            </div>

            <div class="form-group">
                <label>Цена</label>
                <input type="text" name="price" class="form-control"/>
            </div>

            <div class="form-group">
                <label>Количество</label>
                <input type="text" name="quantity" class="form-control"/>
            </div>

            <div class="form-group">
                <label>Производитель</label>
                <input type="text" name="manufacturer" class="form-control"/>
            </div>

            <div class="form-group">
                <label>Категория</label>
                <select name="category" class="form-control">
                    <option value="0">выберите категорию</option>
                    <?php foreach (Category::getAll() as $category) { ?>
                        <option value="<?= $category->id ?>"><?= $category->name ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label>Название товара</label>
                <textarea name="name" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <div class="pull-right">
                    <a class="btn btn-default" href="prodcts.php">Отменить</a>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </div>
            </div>
        </form>
    </div>
</div>
