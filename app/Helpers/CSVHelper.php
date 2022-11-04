<?php

namespace App\Helpers;

use Log;

class CSVHelper
{
    /**
     * CSV/TSVの出力
     */
    public static function output($data, $header, $filename, $csv = false, $headers = [], $is_quot_use = false)
    {
        // 出力するヘッダの調整
        if (!is_array($headers)) {
            $headers = ($csv) ?
                ['text/plain; charset=Shift_JIS'] : ['text/tab-separated-values; charset=Shift_JIS'];
        }
        if (!isset($headers['Content-Type'])) {
            $headers['Content-Type'] = ($csv) ?
                'text/plain; charset=Shift_JIS' : 'text/tab-separated-values; charset=Shift_JIS';
        }
        if (!isset($headers['Content-Disposition'])) {
            $headers['Content-Disposition'] = 'attachment; filename="' . $filename . '"';
        }

        $callback = function () use ($data, $header, $filename, $csv, $is_quot_use) {
            $sep = ($csv) ? ',' : "\t";

            // ヘッダの出力
            $header_data = [];
            mb_convert_variables('cp932', 'utf-8', $header);
            foreach ($header as $_header) {
                if ($is_quot_use) {
                    $header_data[] = '"' . $_header . '"';
                } else {
                    $header_data[] = $_header;
                }
            }
            if (!empty($header) && count($header) > 0) {
                echo implode($sep, $header_data);
                echo chr(0x0d) . chr(0x0a);
            }

            if (!empty($data) && count($data) > 0) {
                foreach ($data as $line) {
                    mb_convert_variables('cp932', 'utf-8', $line);
                    $sv_data = [];
                    foreach ($line as $row) {
                        if ($is_quot_use) {
                            $sv_data[] = '"' . $row . '"';
                        } else {
                            $sv_data[] = $row;
                        }
                    }
                    echo implode($sep, $sv_data);
                    echo chr(0x0d) . chr(0x0a);
                }
            }
        };

        return response()->stream($callback, 200, $headers);
    }
}
