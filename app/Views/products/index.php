<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mini E-Commerce</title>
</head>

<body>
    <h1>Mini E-Commerce</h1>
    <h2>Daftar Produk</h2>

    <?php if (empty($products)): ?>
        <p>Belum ada produk tersedia.</p>
    <?php else: ?>

        <ul>
            <?php foreach ($products as $product): ?>
                <li>
                    <strong>
                        Produk:
                        <?= htmlspecialchars(
                            (string) $product['name'],
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>
                    </strong>

                    <small>

                        Kategori:
                        <?= htmlspecialchars(
                            (string) $product['category_name'],
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>
                    </small>
                    <br>

                    - Rp<?= number_format(
                            (float) $product['price'],
                            0,
                            ',',
                            '.'
                        ) ?>

                    (Stok: <?= (int) $product['stock'] ?>)
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>

</html>