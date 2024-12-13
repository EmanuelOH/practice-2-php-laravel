<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Fill;


class UsersExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        return User::all()->map(function ($user) {
            $countryName = $user->country ? $user->country->name : 'No disponible';

            return [
                $user->id,
                $user->names,
                $user->lastnames,
                $user->email,
                $user->gender,
                $user->phone,
                $user->address,
                $countryName,
                $user->created_at->format('d/m/Y'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID', 
            'Nombre', 
            'Apellido', 
            'Correo Electrónico', 
            'Género', 
            'Teléfono', 
            'Dirección', 
            'País', 
            'Fecha de Creación'
        ];
    }

    public function styles($sheet)
    {
        $highestRow = $sheet->getHighestRow();

        $sheet->getStyle('A1:I1')->applyFromArray([
            'font' => [
                'name' => 'Arial',
                'bold' => true,
                'italic' => true,
                /* 'underline' => Font::UNDERLINE_DOUBLE, */
                'color' => [
                    'rgb' => '000000',
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => [
                        'rgb' => '000000', 
                    ],
                ],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '4CAF50',
                ],
                'endColor' => [
                    'rgb' => 'ff2d00',
                ],
            ],
        ]);

        $sheet->getStyle('A1:I' . $highestRow)->applyFromArray([
            'font' => [
                'name' => 'Arial',
                'bold' => false,
                'color' => [
                    'rgb' => '000000',
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => [
                        'rgb' => '000000',
                    ],
                ],
            ],
        ]);
                
    }
}
