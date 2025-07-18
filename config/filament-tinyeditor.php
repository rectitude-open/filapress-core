<?php

declare(strict_types=1);

return [
    'provider' => 'asset', // cdn|asset

    'cdn_path' => 'https://cdn.jsdelivr.net/npm/tinymce@6.8.5/tinymce.min.js',
    'asset_path' => 'admin-assets/'.config('filapress-core.admin_path', 'admin').'/tinymce/tinymce.min.js',
    // 'asset_path' => 'vendor/tinymce/tinymce.min.js',

    // 'direction' => 'rtl',
    /**
     * change darkMode: 'auto'|'force'|'class'|'media'|false|'custom'
     */
    'darkMode' => 'auto',

    /** cutsom */
    'skins' => [
        // oxide, oxide-dark, tinymce-5, tinymce-5-dark
        'ui' => 'oxide',

        // dark, default, document, tinymce-5, tinymce-5-dark, writer
        'content' => 'default',
    ],

    'profiles' => [
        'default' => [
            'plugins' => 'accordion autoresize codesample directionality advlist link image lists preview pagebreak searchreplace wordcount code fullscreen insertdatetime media table emoticons paste_from_word',
            'toolbar' => 'code undo redo removeformat | styles | bold italic | image link | alignjustify alignleft aligncenter alignright | numlist bullist | forecolor backcolor |  outdent indent | blockquote table toc hr | media codesample emoticons | wordcount fullscreen | rtl ltr',
            'upload_directory' => null,
        ],

        'simple' => [
            'plugins' => 'autoresize directionality emoticons link wordcount',
            'toolbar' => 'removeformat | bold italic | rtl ltr | numlist bullist | link emoticons',
            'upload_directory' => null,
        ],

        'minimal' => [
            'plugins' => 'link wordcount',
            'toolbar' => 'bold italic link numlist bullist',
            'upload_directory' => null,
        ],

        'full' => [
            'plugins' => 'accordion autoresize codesample directionality advlist autolink link image lists charmap preview anchor pagebreak searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media table emoticons template help paste_from_word',
            'toolbar' => 'code | undo redo removeformat | styles | bold italic | alignjustify alignright aligncenter alignleft | numlist bullist outdent indent accordion | forecolor backcolor | blockquote table toc hr | image link anchor media codesample emoticons | visualblocks print preview wordcount fullscreen help | rtl ltr',
            'upload_directory' => null,
        ],
    ],

    /**
     * this option will load optional language file based on you app locale
     * example:
     * languages => [
     *      'fa' => 'https://cdn.jsdelivr.net/npm/tinymce-i18n@23.10.9/langs6/fa.min.js',
     *      'es' => 'https://cdn.jsdelivr.net/npm/tinymce-i18n@23.10.9/langs6/es.min.js',
     *      'ja' => asset('assets/ja.min.js')
     * ]
     */
    'languages' => [],
];
