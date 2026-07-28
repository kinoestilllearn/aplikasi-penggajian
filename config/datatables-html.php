<?php

return [
    /*
     * DataTables JavaScript global namespace.
     */

    'namespace' => 'LaravelDataTables',

    /*
     * Default table attributes when generating the table.
     */
    'table'     => [
        'class' => 'table-responsive display table-striped table-bordered table',
        'id'    => 'dataTableBuilder',
        'style' => 'overflow-x: auto; width: 100%;',
    ],

    /*
     * Html builder script template.
     */
    'script'    => 'datatables::script',

    /*
     * Html builder script template for DataTables Editor integration.
     */
    'editor'    => 'datatables::editor',
];
