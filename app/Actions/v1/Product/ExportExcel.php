<?php

declare(strict_types=1);

namespace App\Actions\v1\Product;

use App\Models\Product;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Throwable;

final class ExportExcel
{
    public function handle(): ApiSuccessResponse | ApiErrorResponse
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');

        try {
            $products = Product::all()->toArray();

            $spreadSheet = new Spreadsheet();

            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);

            $spreadSheet->getActiveSheet()->fromArray($products);

            $Excel_writer = new Xls($spreadSheet);

            header('Content-Type: application/vnd.ms-excel');

            header('Content-Disposition: attachment;filename="products.xls"');

            header('Cache-Control: max-age=0');

            ob_end_clean();

            $Excel_writer->save('php://output');

            exit();
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: $exception->getCode()
            );
        }
    }
}
