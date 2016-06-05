<?php
if (!empty($_FILES)) {
    $need_size = [100, 100];
    $info = getimagesize($_FILES['image']['tmp_name']);
    $real_size = [$info[0], $info[1]];
    $source_image = imagecreatefromstring(file_get_contents($_FILES['image']['tmp_name']));
    $dest_image = imagecreate($need_size[0], $need_size[1]);

    if (($real_size[0]/$real_size[1]) > ($need_size[0]/$need_size[1])) {
        imagecopyresampled($dest_image, $source_image, 0, 0, ($real_size[0] - $real_size[1]) / 2, 0, $need_size[0], $need_size[1], $real_size[1], $real_size[1]);
    } else {
        imagecopyresampled($dest_image, $source_image, 0, 0, 0, ($real_size[1] - $real_size[0]) / 2, $need_size[0], $need_size[1], $real_size[0], $real_size[0]);
    }

    imagepng($dest_image, __DIR__ . '/image.png');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <input type="file" accept="image/png, image/jpg, image/jpeg, image/bmp" name="image"/>
        <button type="submit">Отправить</button>
    </form>
</body>
</html>