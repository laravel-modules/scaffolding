<?php

namespace App\Http\Controllers\Dashboard;

use App\Excel\Exportable;
use App\Excel\GenericExport;
use App\Excel\GenericImport;
use App\Excel\Importable;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Exception;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExcelController extends Controller
{
    /**
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     * @throws ValidationException
     */
    public function export(Request $request): BinaryFileResponse
    {
        $data = $request->validate([
            'extension' => ['required', 'in:xlsx,xls,csv'],
            'model' => ['required', 'string'],
        ]);

        [$extension, $writerType] = $this->resolveExportType($data['extension']);

        $modelClass = $data['model'];

        if (! in_array(Exportable::class, class_implements($modelClass))) {
            throw ValidationException::withMessages([
                'model' => [__('excel.errors.not_exportable', ['model' => $modelClass])],
            ]);
        }

        $query = $modelClass::query();

        if (method_exists($modelClass, 'filter')) {
            $query->filter();
        }

        $filename = $this->generateFilename($modelClass, $extension);

        return Excel::download(
            new GenericExport($query->get(), $modelClass),
            $filename,
            $writerType
        );
    }

    /**
     * @throws ValidationException
     */
    public function import(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'file' => ['required', 'file', 'mimes:csv,xls,xlsx', 'max:2048'],
            'model' => ['required', 'string'],
        ]);

        $modelClass = $data['model'];

        if (! in_array(Importable::class, class_implements($modelClass))) {
            throw ValidationException::withMessages([
                'model' => [__('excel.errors.not_importable', ['model' => $modelClass])],
            ]);
        }

        Excel::import(
            new GenericImport($modelClass),
            request()->file('file')
        );

        flash(__('excel.messages.imported'));

        return back();
    }

    /**
     * Resolve extension + writer type
     */
    private function resolveExportType(string $extension): array
    {
        return match ($extension) {
            'xlsx' => ['xlsx', \Maatwebsite\Excel\Excel::XLSX],
            'csv' => ['csv', \Maatwebsite\Excel\Excel::CSV],
            default => ['xls', \Maatwebsite\Excel\Excel::XLS],
        };
    }

    /**
     * Generate export filename
     */
    private function generateFilename(string $modelClass, string $extension): string
    {
        $name = str($modelClass)->classBasename()->plural()->kebab()->toString();

        return "{$name}-".now()->format('Y_m_d_His').".{$extension}";
    }
}
