<?php

declare(strict_types=1);

namespace App\Actions\v1\Product;

use App\DTO\v1\Product\ImportProductDTO;
use App\Models\Product;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Throwable;

final class ImportProduct
{
    public function handle(ImportProductDTO $dto): ApiSuccessResponse | ApiErrorResponse
    {
        $data = $dto->toArray();

        try {
            $spreadsheet = IOFactory::load($data['upload_file']->getRealPath());

            $sheet        = $spreadsheet->getActiveSheet();

            $row_limit    = $sheet->getHighestDataRow();

            $column_limit = $sheet->getHighestDataColumn();

            $row_range    = range(2, $row_limit);

            $column_range = range('J', $column_limit);

            $startCount = 2;

            $data = array();

            foreach ($row_range as $row) {
                $data[] = [
                    'name' => $sheet->getCell('A' . $row)->getValue(),
                    'category_id' => $sheet->getCell('B' . $row)->getValue(),
                    'supplier_id' => $sheet->getCell('C' . $row)->getValue(),
                    'code' => $sheet->getCell('D' . $row)->getValue(),
                    'garage' => $sheet->getCell('E' . $row)->getValue(),
                    'image' => $sheet->getCell('F' . $row)->getValue(),
                    'store' => $sheet->getCell('G' . $row)->getValue(),
                    'buying_date' => $sheet->getCell('H' . $row)->getValue(),
                    'expire_date' => $sheet->getCell('I' . $row)->getValue(),
                    'buying_price' => $sheet->getCell('J' . $row)->getValue(),
                    'selling_price' => $sheet->getCell('K' . $row)->getValue(),
                ];

                $startCount++;
            }

            Product::insert($data);
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: $exception->getCode()
            );
        }
    }
}
