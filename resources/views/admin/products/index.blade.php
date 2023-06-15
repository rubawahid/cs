<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <div class="contanier">
        <h2 class = "mb-4 fs-3"><?= $title ?></h2>
        <a href="<?php echo route('products.create') ?>" class="btn btn-sm btn-primary">+ create Product</a>
<table class = "table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Catogery</th>
            <th>Price</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product) : ?>
        <tr>
            <td><?= $product->id ?></td>
            <td><?= $product->name ?></td>
            <td><?= $product->category_name ?></td>
            <td><?= $product->price ?></td>
            <td><?= $product->statuss ?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>