INSERT INTO
    `alamat` (
        `id`,
        `user_id`,
        `nama_alamat`,
        `no_hp`,
        `nama_penerima`,
        `province_id`,
        `city_id`,
        `kode_pos`,
        `alamat_lengkap`,
        `created_at`,
        `updated_at`,
        `deleted_at`
    )
VALUES (
        1,
        4,
        'Alamat rumah',
        '0812345678910',
        'Dzaki Ahnaf Z',
        '9',
        '115',
        '14334',
        'Jl raya depok',
        NULL,
        NULL,
        NULL
    ),
    (
        2,
        4,
        'Alamat rumah 2',
        '0812345678910',
        'Dzaki Ahnaf Z',
        '1',
        '17',
        '12121',
        'Bali',
        NULL,
        NULL,
        NULL
    );

COMMIT;
