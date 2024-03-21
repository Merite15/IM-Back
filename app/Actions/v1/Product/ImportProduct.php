<?php

declare(strict_types=1);

namespace App\Actions\v1\Product;

use App\DTO\v1\Product\ImportProductDTO;
use App\Models\Product;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Illuminate\Http\Response;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Throwable;

final class ImportProduct
{
    public function handle(ImportProductDTO $dto): ApiSuccessResponse | ApiErrorResponse
    {
        try {
            $spreadsheet = IOFactory::load($dto->getUploadFiles()->getRealPath());

            $sheet        = $spreadsheet->getActiveSheet();

            $row_limit    = $sheet->getHighestDataRow();

            $row_range    = range(2, $row_limit);

            $startCount = 2;

            $data = [];

            foreach ($row_range as $row) {
                $data[] = [
                    'name'          => $sheet->getCell('A' . $row)->getValue(),
                    'slug'          => $sheet->getCell('B' . $row)->getValue(),
                    'category_id'   => $sheet->getCell('C' . $row)->getValue(),
                    'unit_id'       => $sheet->getCell('D' . $row)->getValue(),
                    'code'          => $sheet->getCell('E' . $row)->getValue(),
                    'quantity'      => $sheet->getCell('F' . $row)->getValue(),
                    "quantity_alert" => $sheet->getCell('G' . $row)->getValue(),
                    'buying_price'  => $sheet->getCell('H' . $row)->getValue(),
                    'selling_price' => $sheet->getCell('I' . $row)->getValue(),
                    'product_image' => $sheet->getCell('J' . $row)->getValue(),
                    'notes' => $sheet->getCell('K' . $row)->getValue(),
                ];

                $startCount++;
            }

            foreach ($data as $product) {
                Product::firstOrCreate([
                    "slug" => $product["slug"],
                    "code" => $product["code"],
                ], $product);
            }

            return new ApiSuccessResponse(
                message: 'Produis importés avec succès',
                code: Response::HTTP_OK
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: $exception->getCode()
            );
        }

        // try {
        //     $spreadsheet = IOFactory::load($data['upload_file']->getRealPath());

        //     $sheet        = $spreadsheet->getActiveSheet();

        //     $row_limit    = $sheet->getHighestDataRow();

        //     $column_limit = $sheet->getHighestDataColumn();

        //     $row_range    = range(2, $row_limit);

        //     $column_range = range('J', $column_limit);

        //     $startCount = 2;

        //     $data = array();

        //     foreach ($row_range as $row) {
        //         $data[] = [
        //             'name' => $sheet->getCell('A' . $row)->getValue(),
        //             'category_id' => $sheet->getCell('B' . $row)->getValue(),
        //             'supplier_id' => $sheet->getCell('C' . $row)->getValue(),
        //             'code' => $sheet->getCell('D' . $row)->getValue(),
        //             'garage' => $sheet->getCell('E' . $row)->getValue(),
        //             'image' => $sheet->getCell('F' . $row)->getValue(),
        //             'store' => $sheet->getCell('G' . $row)->getValue(),
        //             'buying_date' => $sheet->getCell('H' . $row)->getValue(),
        //             'expire_date' => $sheet->getCell('I' . $row)->getValue(),
        //             'buying_price' => $sheet->getCell('J' . $row)->getValue(),
        //             'selling_price' => $sheet->getCell('K' . $row)->getValue(),
        //         ];

        //         $startCount++;
        //     }

        //     Product::insert($data);
        // } catch (Throwable $exception) {
        //     return new ApiErrorResponse(
        //         exception: $exception,
        //         code: $exception->getCode()
        //     );
        // }
    }
}
