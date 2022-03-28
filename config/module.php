<?php


return [
    'charge' => [
        'key'=>"charge",
        'title'=>"Nạp thẻ tự động",
        'status' => [
            '1' => 'Thẻ đúng',
            '0' => 'Thẻ sai',
            '2' => 'Chờ xử lý',
            '3' => 'Sai mệnh giá',
            '999' => 'Lỗi nạp thẻ',
            '-999' => 'Lỗi nạp thẻ',
            '-1' => 'Phát sinh lỗi nạp thẻ',
        ],
    ],
    'tranfer' => [
        'key'=>"charge",
        'title'=>"Nạp ATM tự động",
        'status' => [
            '1' => 'Thành công(Đúng số tiền)',
            '0' => 'Thất bại',
            '2' => 'Chờ xử lý',
            '3' => 'Thành công(Sai số tiền)',
        ],
    ],
    'acc' => [
        'key'=>"charge",
        'status' => [
            '1' => 'Mua thành công',
            '2' => 'Chờ kiểm tra tài khoản',
        ],
        'price' => [
            'Dưới 50K' => 'Dưới 50K',
            'Từ 50K - 200K' => 'Từ 50K - 200K',
            'Từ 200K - 500K' => 'Từ 200K - 500K',
            'Từ 500K - 1 Triệu' => 'Từ 500K - 1 Triệu',
            'Trên 1 Triệu' => 'Trên 1 Triệu',
            'Trên 5 Triệu' => 'Trên 5 Triệu',
            'Trên 10 Triệu' => 'Trên 10 Triệu',
        ],
    ],
];
