<?php
namespace xlswriter;

/**
 * Class example
 *
 * @package xlswriter
 */
class example
{
    /**
     * 多sheet写入.
     *
     * @param $data       array  多维数组 [
     *                    [
     *                    'username'=>'张三',
     *                    'age'=>'18',
     *                    'add_time'=>'2022-12-12',
     *                    ]
     *                    ]
     * @param $colName    array  [
     *                    [
     *                    'username'   => '用户|string|20',
     *                    'age'   => '年龄|number|10',
     *                    'add_time'  => '导入时间|datetime|20',
     *                    ]
     *                    ]
     * @param $excelTitle array ['sheet1']
     * @param $filePath   string 文件名
     */
    function exportExcelMulti($data, $colName, $excelTitle, $filePath)
    {
        $writer = new \XLSXWriter();
        foreach ($data as $key => $list) {
            $keys     = array_keys($colName[$key]);
            $colStyle = $colWidth = $mapField = [];
            foreach ($colName[$key] as $format) {
                list($numFormat, $style, $width) = explode('|', $format);
                $mapField[] = $numFormat;
                $colStyle[] = $style;
                $colWidth[] = !empty($width) ? (int)$width : 16;
            }

            $writer->writeSheetHeader($excelTitle[$key], $colStyle, array('suppress_row' => true, 'widths' => $colWidth));

            $writer->writeSheetRow(
                $excelTitle[$key],
                [$excelTitle[$key]],
                ['height' => 32, 'font-size' => 20, 'font-style' => 'bold', 'halign' => 'center', 'valign' => 'center']
            );
            //合并标题
            $endCol = count($colName[$key]) - 1;
            $writer->markMergedCell($excelTitle[$key], $startRow = 0, $startCol = 0, $endRow = 0, $endCol);
            //写入标题头
            $styles = array(
                'font'       => '宋体',
                'font-size'  => 10,
                'font-style' => 'bold',
                'fill'       => '#838383',
                'height'     => 24,
                'halign'     => 'center',
                'valign'     => 'center',
                'border'     => 'left,right,top,bottom',
                'header'     => true, //固定标题头
            );
            $writer->writeSheetRow($excelTitle[$key], $mapField, $styles);
            //写入数据行
            $styles = ['height' => 30, 'wrap_text' => true];
            foreach ($list as $row) {
                $arr = [];
                foreach ($keys as $col) {
                    if (isset($row[$col])) {
                        $arr[$col] = $row[$col] ?: '';
                    }
                }
                $writer->writeSheetRow($excelTitle[$key], $arr, $styles);
            }
        }
       #$writer->writeToFile($filePath);
       var_dump($writer->writeToString());
    }
}



