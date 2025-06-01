INSERT INTO
    `produk` (
        `id`,
        `kategori_id`,
        `user_id`,
        `nama_produk`,
        `slug_produk`,
        `foto_produk`,
        `harga`,
        `stock`,
        `berat`,
        `detail`,
        `status`,
        `created_at`,
        `updated_at`
    )
VALUES (
        1,
        4,
        1,
        'Chocolate fudge cake',
        'chocolate-fudge-cake',
        'uploads/produk/4a3314c3-cedb-4a5c-a29e-2fdd0a6670d5.webp',
        75000,
        1000,
        1000,
        '-',
        'active',
        '2025-05-26 12:38:28',
        '2025-05-27 06:38:44'
    ),
    (
        2,
        4,
        1,
        'Cupcake',
        'cupcake',
        NULL,
        30000,
        100,
        90,
        '-',
        'active',
        '2025-05-27 06:21:33',
        '2025-05-27 07:19:15'
    );

INSERT INTO
    `foto_produk` (
        `id`,
        `produk_id`,
        `foto_produk`,
        `created_at`,
        `updated_at`
    )
VALUES (
        1,
        1,
        'uploads/produk/ce47c296-81d5-4e5c-ae39-c690123ec68d.webp',
        '2025-05-27 05:49:42',
        '2025-05-27 05:49:42'
    ),
    (
        2,
        1,
        'uploads/produk/4182ca73-df70-4972-aa2d-b2c867a14d4f.webp',
        '2025-05-27 05:49:57',
        '2025-05-27 05:49:57'
    );

COMMIT;
