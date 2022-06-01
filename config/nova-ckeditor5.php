<?php

return [
    /** Height for CKEditor */
    'height' => 300,

    /** Language */
    'lang' => 'en',
    'content-lang' => 'en',

    'storage' => [
        /** Disk used for uploaded attachments */
        'disk' => 'public',
        /** Path used for uploaded attachments */
        'path' => 'attachments'
    ],

    /** Uploader class. Use own if want specific image processing */
    'attachment_uploader' => \Realevd\NovaCkeditor5\AttachmentUploader::class,

    'image_process' => [
        /** Resize image to this dimensions */
        'max_width' => 1024,
        'max_height' => 768,
    ],

    /** Setup buttons on toolbar */
    'toolbar' => [
        'heading',
        '|',
        'fontSize',
        'fontFamily',
        'fontColor',
        'fontBackgroundColor',
        '|',
        'insertTable',
        'imageUpload',
//                'image',
        'mediaEmbed',
        'link',
        '|',
        'bold',
        'italic',
        'alignment',
        'horizontalLine',
        'subscript',
        'superscript',
        'underline',
        'strikethrough',
        'code',
        '|',
        'outdent',
        'indent',
        '|',
        'codeBlock',
        'blockQuote',
        'bulletedList',
        'numberedList',
        '|',
        'htmlEmbed',
        '|',
        'undo',
        'redo',
        '|',
        'sourceEditing'
    ],
    /** When set to true, the toolbar will stop grouping items and let them wrap to the next line when there is not enough space to display them in a single row.  */
    'shouldNotGroupWhenFull' => false,
    /** Additional options pass to CKEditor instance. See CKEditor5 documentation */
    'options' => [
        'fontFamily' => [
            'supportAllValues' => false,
            'options' => [
                'default',
                'Arial, Helvetica, sans-serif',
                'Courier New, Courier, monospace',
                'Georgia, serif',
                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                'Tahoma, Geneva, sans-serif',
                'Times New Roman, Times, serif',
                'Trebuchet MS, Helvetica, sans-serif',
                'Verdana, Geneva, sans-serif'
            ]
        ],
        'fontSize' => [
            'options' => [
                'tiny',
                'small',
                'default',
                'big',
                'huge'
            ]
        ],
        'fontColor' => [
            'columns' => 5,
            'colors' => [
                ['color' => 'hsl(0, 0%, 0%)', 'label' => 'Black'],
                ['color' => 'hsl(0, 0%, 30%)', 'label' => 'Dim grey'],
                ['color' => 'hsl(0, 0%, 60%)', 'label' => 'Grey'],
                ['color' => 'hsl(0, 0%, 90%)', 'label' => 'Light grey'],
                ['color' => 'hsl(0, 0%, 100%)', 'label' => 'White', 'hasBorder' => true],
                ['color' => 'hsl(0, 75%, 60%)', 'label' => 'Red'],
                ['color' => 'hsl(30, 75%, 60%)', 'label' => 'Orange'],
                ['color' => 'hsl(60, 75%, 60%)', 'label' => 'Yellow'],
                ['color' => 'hsl(90, 75%, 60%)', 'label' => 'Light green'],
                ['color' => 'hsl(120, 75%, 60%)', 'label' => 'Green'],
                ['color' => 'hsl(150, 75%, 60%)', 'label' => 'Aquamarine'],
                ['color' => 'hsl(180, 75%, 60%)', 'label' => 'Turquoise'],
                ['color' => 'hsl(210, 75%, 60%)', 'label' => 'Light blue'],
                ['color' => 'hsl(240, 75%, 60%)', 'label' => 'Blue'],
                ['color' => 'hsl(270, 75%, 60%)', 'label' => 'Purple']
            ]
        ],

        'fontBackgroundColor' => [
            'columns' => 5,
            'colors' => [
                ['color' => 'hsl(0, 0%, 0%)', 'label' => 'Black'],
                ['color' => 'hsl(0, 0%, 30%)', 'label' => 'Dim grey'],
                ['color' => 'hsl(0, 0%, 60%)', 'label' => 'Grey'],
                ['color' => 'hsl(0, 0%, 90%)', 'label' => 'Light grey'],
                ['color' => 'hsl(0, 0%, 100%)', 'label' => 'White', 'hasBorder' => true],
                ['color' => 'hsl(0, 75%, 60%)', 'label' => 'Red'],
                ['color' => 'hsl(30, 75%, 60%)', 'label' => 'Orange'],
                ['color' => 'hsl(60, 75%, 60%)', 'label' => 'Yellow'],
                ['color' => 'hsl(90, 75%, 60%)', 'label' => 'Light green'],
                ['color' => 'hsl(120, 75%, 60%)', 'label' => 'Green'],
                ['color' => 'hsl(150, 75%, 60%)', 'label' => 'Aquamarine'],
                ['color' => 'hsl(180, 75%, 60%)', 'label' => 'Turquoise'],
                ['color' => 'hsl(210, 75%, 60%)', 'label' => 'Light blue'],
                ['color' => 'hsl(240, 75%, 60%)', 'label' => 'Blue'],
                ['color' => 'hsl(270, 75%, 60%)', 'label' => 'Purple']
            ]
        ]
    ],
];
