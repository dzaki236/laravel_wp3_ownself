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
        1,
        1,
        'Chocolate fudge cake',
        'chocolate-fudge-cake',
        'uploads/produk/4a3314c3-cedb-4a5c-a29e-2fdd0a6670d5.webp',
        75000,
        1000,
        1000,
        '<p>-</p>',
        'active',
        '2025-05-26 20:38:28',
        '2025-06-11 23:30:54'
    ),
    (
        2,
        4,
        1,
        'Cupcake',
        'cupcake',
        'uploads/produk/8c34e84c-17f5-4eee-a9fd-9eba5aec33a9.webp',
        30000,
        10,
        90,
        '<p>-</p>',
        'active',
        '2025-05-27 14:21:33',
        '2025-06-11 23:29:55'
    ),
    (
        3,
        3,
        1,
        'Baguette',
        'baguette',
        'uploads/produk/a028f9bf-dbfa-4782-9b20-b3f83642f2fd.webp',
        30000,
        10,
        100,
        NULL,
        'active',
        '2025-06-11 23:14:38',
        '2025-06-11 23:23:33'
    ),
    (
        4,
        2,
        1,
        'Kue Jahe',
        'kue-jahe',
        'uploads/produk/de085d07-4223-40fe-b8c3-35c3e615a758.webp',
        25000,
        10,
        50,
        NULL,
        'active',
        '2025-06-11 23:33:27',
        '2025-06-11 23:40:16'
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
        '2025-05-27 13:49:42',
        '2025-05-27 13:49:42'
    ),
    (
        2,
        1,
        'uploads/produk/4182ca73-df70-4972-aa2d-b2c867a14d4f.webp',
        '2025-05-27 13:49:57',
        '2025-05-27 13:49:57'
    ),
    (
        3,
        3,
        'uploads/produk/813f00d9-db2a-4d3e-a756-3563e9a2dd8c.webp',
        '2025-06-11 20:29:05',
        '2025-06-11 20:29:05'
    );

COMMIT;
