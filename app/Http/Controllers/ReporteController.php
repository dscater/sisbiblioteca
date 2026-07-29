<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\DatosUsuario;
use App\Models\Libro;
use App\Models\Area;
use App\Models\Autor;
use App\Models\Edicion;
use App\Models\Editorial;
use App\Models\Lugar;
use App\Models\Ubicacion;
use App\Models\SolicitudPrestamo;
use App\Models\Prestamo;
use Illuminate\Support\Facades\DB;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ReporteController extends Controller
{
    public function index()
    {
        $areas = Area::all();
        $autors = Autor::all();
        $edicions = Edicion::all();
        $editorials = Editorial::all();
        $lugars = Lugar::all();
        $ubicacions = Ubicacion::all();
        return view('reportes.index', compact('areas', 'autors', 'edicions', 'editorials', 'lugars', 'ubicacions'));
    }

    public function usuarios(Request $request)
    {
        $filtro = $request->filtro;
        $tipo = $request->tipo;

        $usuarios = DatosUsuario::select('datos_usuarios.*', 'users.id as user_id', 'users.name as usuario', 'users.foto', 'users.tipo')
            ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
            ->where('users.estado', 1)
            ->orderBy('datos_usuarios.nombre', 'ASC')
            ->get();

        if ($filtro != 'todos') {
            if ($tipo != 'todos') {
                $usuarios = DatosUsuario::select('datos_usuarios.*', 'users.id as user_id', 'users.name as usuario', 'users.foto')
                    ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
                    ->where('users.estado', 1)
                    ->where('users.tipo', $tipo)
                    ->orderBy('datos_usuarios.nombre', 'ASC')
                    ->get();
            }
        }

        $pdf = PDF::loadView('reportes.usuarios', compact('usuarios'))->setPaper('letter', 'landscape');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->stream('Usuarios.pdf');
    }

    public function libros(Request $request)
    {
        $filtro = $request->filtro;
        $area = $request->area;
        $autor = $request->autor;
        $editorial = $request->editorial;
        $lugar = $request->lugar;
        $anio = $request->anio;
        $ubicacion = $request->ubicacion;
        $estado = $request->estado;
        $portal = $request->portal;

        $libros = Libro::where('status', 1)->get();

        switch ($filtro) {
            case 'area':
                if ($area != 'todos') {
                    $libros = Libro::where('status', 1)
                        ->where('area_id', $area)->get();
                }
                break;
            case 'autor':
                if ($autor != 'todos') {
                    $libros = Libro::where('status', 1)
                        ->where('autor_id', $autor)->get();
                }
                break;
            case 'editorial':
                if ($editorial != 'todos') {
                    $libros = Libro::where('status', 1)
                        ->where('editorial_id', $editorial)->get();
                }
                break;
            case 'lugar':
                if ($lugar != 'todos') {
                    $libros = Libro::where('status', 1)
                        ->where('lugar_id', $lugar)->get();
                }
                break;
            case 'anio':
                if ($anio != 'todos') {
                    $libros = Libro::where('status', 1)
                        ->where('fecha_anio', $anio)->get();
                }
                break;
            case 'ubicacion':
                if ($ubicacion != 'todos') {
                    $libros = Libro::where('status', 1)
                        ->where('ubicacion_id', $ubicacion)->get();
                }
                break;
            case 'estado':
                if ($estado != 'todos') {
                    $libros = Libro::where('status', 1)
                        ->where('estado', $estado)->get();
                }
                break;
            case 'portal':
                if ($portal != 'todos') {
                    $libros = Libro::where('status', 1)
                        ->where('portal', $portal)->get();
                }
                break;
        }

        $tipo_reporte = $request->tipo_reporte;
        if ($tipo_reporte == 'pdf') {
            $pdf = PDF::loadView('reportes.libros', compact('libros'))->setPaper('legal', 'landscape');
            // ENUMERAR LAS PÁGINAS USANDO CANVAS
            $pdf->output();
            $dom_pdf = $pdf->getDomPDF();
            $canvas = $dom_pdf->get_canvas();
            $alto = $canvas->get_height();
            $ancho = $canvas->get_width();
            $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

            return $pdf->stream('Libros.pdf');
        } else {
            $spreadsheet = new Spreadsheet();
            $spreadsheet->getProperties()
                ->setCreator("Biblioteca")
                ->setLastModifiedBy('Administración')
                ->setTitle('Lista de libros')
                ->setSubject('Lista de libros')
                ->setDescription('Lista de libros')
                ->setKeywords('PHPSpreadsheet')
                ->setCategory('Listado');

            $sheet = $spreadsheet->getActiveSheet();

            $spreadsheet->getDefaultStyle()->getFont()->setName('Arial');
            $styleArray = [
                'font' => [
                    'bold' => true,
                    'size' => 12
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ];
            $sheet->getStyle('B1:W1')->applyFromArray($styleArray);
            $spreadsheet->getDefaultStyle()->getFont()->setSize(10);
            // LLENADO DEL REPORTE
            $sheet->setCellValue('B1', 'INVENTARIO DE LIBROS');
            $sheet->mergeCells("B1:W1");  //COMBINAR CELDAS
            // ENCABEZADO
            $sheet->setCellValue('B2', 'Nº');
            $sheet->setCellValue('C2', 'TÍTULO');
            $sheet->setCellValue('D2', 'ÁREA');
            $sheet->setCellValue('E2', 'AUTOR');
            $sheet->setCellValue('F2', 'EDICIÓN');
            $sheet->setCellValue('G2', 'VOLUMEN');
            $sheet->setCellValue('H2', 'LUGAR');
            $sheet->setCellValue('I2', 'EDITORIAL');
            $sheet->setCellValue('J2', 'AÑO');
            $sheet->setCellValue('K2', 'NRO. PÁGS.');
            $sheet->setCellValue('L2', 'ISBN');
            $sheet->setCellValue('M2', 'PROCEDENCIA');
            $sheet->setCellValue('N2', 'PRECIO');
            $sheet->setCellValue('O2', 'SIGNATURA');
            $sheet->setCellValue('P2', 'ESTADO');
            $sheet->setCellValue('Q2', 'TIPO');
            $sheet->setCellValue('R2', 'UBICACIÓN');
            $sheet->setCellValue('S2', 'PORTAL');
            $sheet->setCellValue('T2', 'DESCRIPTORES/PALABRAS CLAVE');
            $sheet->setCellValue('U2', 'RESUMEN/INDICE');
            $sheet->setCellValue('V2', 'OBSERVACIONES');
            $sheet->setCellValue('W2', 'FECHA REGISTRO');

            $styleArray = [
                'font' => [
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ];
            $sheet->getStyle('B2:W2')->applyFromArray($styleArray);

            // RECORRER LOS REGISTROS
            $nro_fila = 3;
            $cont = 1;
            foreach ($libros as $libro) {
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                    'alignment' => [
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ];
                $sheet->getStyle('B' . $nro_fila . ':W' . $nro_fila)->applyFromArray($styleArray);

                $sheet->setCellValue('B' . $nro_fila, $cont++);
                $sheet->setCellValue('C' . $nro_fila, $libro->titulo);
                $sheet->setCellValue('D' . $nro_fila, $libro->area->nombre);
                $sheet->setCellValue('E' . $nro_fila, $libro->autor->nombre);
                $sheet->setCellValue('F' . $nro_fila, $libro->edicion->nombre);
                $sheet->setCellValue('G' . $nro_fila, $libro->volumen->nombre);
                $sheet->setCellValue('H' . $nro_fila, $libro->lugar->nombre);
                $sheet->setCellValue('I' . $nro_fila, $libro->editorial->nombre);
                $sheet->setCellValue('J' . $nro_fila, $libro->fecha_anio);
                $sheet->setCellValue('K' . $nro_fila, $libro->nro_paginas);
                $sheet->setCellValue('L' . $nro_fila, $libro->isbn);
                $sheet->setCellValue('M' . $nro_fila, $libro->procedencia);
                $sheet->setCellValue('N' . $nro_fila, $libro->precio);
                $sheet->setCellValue('O' . $nro_fila, $libro->signatura);
                $sheet->setCellValue('P' . $nro_fila, $libro->estado);
                $sheet->setCellValue('Q' . $nro_fila, $libro->tipo);
                $sheet->setCellValue('R' . $nro_fila, $libro->ubicacion->estante . ' - ' . $libro->ubicacion->balda);
                $sheet->setCellValue('S' . $nro_fila, $libro->portal);
                $sheet->setCellValue('T' . $nro_fila, $libro->descriptores);
                $sheet->setCellValue('U' . $nro_fila, $libro->resumen);
                $sheet->setCellValue('V' . $nro_fila, $libro->observaciones);
                $sheet->setCellValue('W' . $nro_fila, date('d/m/Y', strtotime($libro->fecha_registro)));
                $nro_fila++;
            }

            // AJUSTAR EL ANCHO DE LAS CELDAS
            foreach (range('B', 'W') as $columnID) {
                if ($columnID == 'U') {
                    $sheet->getStyle($columnID)->getAlignment()->setWrapText(true);
                    $sheet->getColumnDimension($columnID)
                        ->setWidth(200);
                } else {
                    $sheet->getColumnDimension($columnID)
                        ->setAutoSize(true);
                }
            }

            // DESCARGA DEL ARCHIVO
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="ListaLibros.xlsx"');
            header('Cache-Control: max-age=0');
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
        }
    }

    public function libros_mas_prestados(Request $request)
    {
        $filtro = $request->filtro;
        $fecha_ini = $request->fecha_ini;
        $fecha_fin = $request->fecha_fin;

        $libros = DB::select("SELECT l.id, l.nro_inventario, l.fecha_ingreso, l.titulo, l.fecha_anio, 
        l.tipo,l.portal, l.nro_paginas, l.isbn, l.procedencia, l.precio, l.signatura, l.estado, ar.nombre as area ,au.nombre as autor, v.nombre as volumen, 
        e.nombre as editorial, ed.nombre as edicion, lug.nombre as lugar, CONCAT(u.estante,'-',u.balda) as ubicacion, COUNT(p.id) AS nro_prestamos
                FROM libros l JOIN areas a ON a.id = l.area_id
                JOIN areas ar ON ar.id = l.area_id
                JOIN autors au ON au.id = l.autor_id
                JOIN volumens v ON v.id = l.volumen_id
                JOIN editorials e ON e.id = l.editorial_id
                JOIN edicions ed ON ed.id = l.edicion_id
                JOIN lugars lug ON lug.id = l.lugar_id
                JOIN ubicacions u ON u.id = l.ubicacion_id
                JOIN prestamos p ON p.libro_id = l.id
                WHERE l.status = 1
                AND p.estado IN (1,2)
                AND p.descripcion = 'PRESTAMO'
                GROUP BY p.libro_id
                ORDER BY COUNT(p.id) DESC
        ");

        if ($filtro == 'fecha') {
            if ($fecha_ini != '' && $fecha_fin != '') {
                $libros = DB::select("SELECT l.id, l.nro_inventario, l.fecha_ingreso, l.titulo, l.fecha_anio, 
        l.tipo,l.portal, l.nro_paginas, l.isbn, l.procedencia, l.precio, l.signatura, l.estado, ar.nombre as area ,au.nombre as autor, v.nombre as volumen, 
        e.nombre as editorial, ed.nombre as edicion, lug.nombre as lugar, CONCAT(u.estante,'-',u.balda) as ubicacion, COUNT(p.id) AS nro_prestamos
                FROM libros l JOIN areas a ON a.id = l.area_id
                JOIN areas ar ON ar.id = l.area_id
                JOIN autors au ON au.id = l.autor_id
                JOIN volumens v ON v.id = l.volumen_id
                JOIN editorials e ON e.id = l.editorial_id
                JOIN edicions ed ON ed.id = l.edicion_id
                JOIN lugars lug ON lug.id = l.lugar_id
                JOIN ubicacions u ON u.id = l.ubicacion_id
                JOIN prestamos p ON p.libro_id = l.id
                WHERE l.status = 1
                AND p.estado IN (1,2)
                AND p.fecha_registro BETWEEN '$fecha_ini' AND '$fecha_fin'
                AND p.descripcion = 'PRESTAMO'
                GROUP BY p.libro_id
                ORDER BY COUNT(p.id) DESC
        ");
            }
        }

        $tipo_reporte = $request->tipo_reporte;
        if ($tipo_reporte == 'pdf') {
            $pdf = PDF::loadView('reportes.libros_mas_prestados', compact('libros'))->setPaper('legal', 'landscape');
            // ENUMERAR LAS PÁGINAS USANDO CANVAS
            $pdf->output();
            $dom_pdf = $pdf->getDomPDF();
            $canvas = $dom_pdf->get_canvas();
            $alto = $canvas->get_height();
            $ancho = $canvas->get_width();
            $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

            return $pdf->stream('LibrosMasPrestados.pdf');
        } else {
            $spreadsheet = new Spreadsheet();
            $spreadsheet->getProperties()
                ->setCreator("Biblioteca")
                ->setLastModifiedBy('Administración')
                ->setTitle('Lista de libros mas prestasdos')
                ->setSubject('Lista de libros mas prestados')
                ->setDescription('Lista de libros mas prestados')
                ->setKeywords('PHPSpreadsheet')
                ->setCategory('Listado mas prestados');

            $sheet = $spreadsheet->getActiveSheet();

            $spreadsheet->getDefaultStyle()->getFont()->setName('Arial');
            $styleArray = [
                'font' => [
                    'bold' => true,
                    'size' => 12
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ];
            $sheet->getStyle('B1:T1')->applyFromArray($styleArray);
            $spreadsheet->getDefaultStyle()->getFont()->setSize(10);
            // LLENADO DEL REPORTE
            $sheet->setCellValue('B1', 'INVENTARIO DE LIBROS');
            $sheet->mergeCells("B1:U1");  //COMBINAR CELDAS
            // ENCABEZADO
            $sheet->setCellValue('B2', 'Nº');
            $sheet->setCellValue('C2', 'TÍTULO');
            $sheet->setCellValue('D2', 'ÁREA');
            $sheet->setCellValue('E2', 'AUTOR');
            $sheet->setCellValue('F2', 'EDICIÓN');
            $sheet->setCellValue('G2', 'VOLUMEN');
            $sheet->setCellValue('H2', 'LUGAR');
            $sheet->setCellValue('I2', 'EDITORIAL');
            $sheet->setCellValue('J2', 'AÑO');
            $sheet->setCellValue('K2', 'NRO. PÁGS.');
            $sheet->setCellValue('L2', 'ISBN');
            $sheet->setCellValue('M2', 'PROCEDENCIA');
            $sheet->setCellValue('N2', 'PRECIO');
            $sheet->setCellValue('O2', 'SIGNATURA');
            $sheet->setCellValue('P2', 'ESTADO');
            $sheet->setCellValue('Q2', 'TIPO');
            $sheet->setCellValue('R2', 'UBICACIÓN');
            $sheet->setCellValue('S2', 'PORTAL');
            $sheet->setCellValue('T2', 'Nro. Préstamos');

            $styleArray = [
                'font' => [
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ];
            $sheet->getStyle('B2:T2')->applyFromArray($styleArray);

            // RECORRER LOS REGISTROS
            $nro_fila = 3;
            $cont = 1;
            foreach ($libros as $libro) {
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ];
                $sheet->getStyle('B' . $nro_fila . ':T' . $nro_fila)->applyFromArray($styleArray);

                $sheet->setCellValue('B' . $nro_fila, $cont++);
                $sheet->setCellValue('C' . $nro_fila, $libro->titulo);
                $sheet->setCellValue('D' . $nro_fila, $libro->area);
                $sheet->setCellValue('E' . $nro_fila, $libro->autor);
                $sheet->setCellValue('F' . $nro_fila, $libro->edicion);
                $sheet->setCellValue('G' . $nro_fila, $libro->volumen);
                $sheet->setCellValue('H' . $nro_fila, $libro->lugar);
                $sheet->setCellValue('I' . $nro_fila, $libro->editorial);
                $sheet->setCellValue('J' . $nro_fila, $libro->fecha_anio);
                $sheet->setCellValue('K' . $nro_fila, $libro->nro_paginas);
                $sheet->setCellValue('L' . $nro_fila, $libro->isbn);
                $sheet->setCellValue('M' . $nro_fila, $libro->procedencia);
                $sheet->setCellValue('N' . $nro_fila, $libro->precio);
                $sheet->setCellValue('O' . $nro_fila, $libro->signatura);
                $sheet->setCellValue('P' . $nro_fila, $libro->estado);
                $sheet->setCellValue('Q' . $nro_fila, $libro->tipo);
                $sheet->setCellValue('R' . $nro_fila, $libro->ubicacion);
                $sheet->setCellValue('S' . $nro_fila, $libro->portal);
                $sheet->setCellValue('T' . $nro_fila, $libro->nro_prestamos);
                $nro_fila++;
            }

            // AJUSTAR EL ANCHO DE LAS CELDAS
            foreach (range('B', 'T') as $columnID) {
                $sheet->getColumnDimension($columnID)
                    ->setAutoSize(true);
            }

            // DESCARGA DEL ARCHIVO
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="ListaLibrosMasPrestados.xlsx"');
            header('Cache-Control: max-age=0');
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
        }
    }

    public function lista_solicitudes(Request $request)
    {
        $filtro = $request->filtro;
        $fecha_ini = $request->fecha_ini;
        $fecha_fin = $request->fecha_fin;

        $solicituds = SolicitudPrestamo::all();

        if ($filtro == 'fecha') {
            if ($fecha_ini != '' && $fecha_fin != '') {
                $solicituds = SolicitudPrestamo::whereBetween('fecha_registro', [$fecha_ini, $fecha_fin])->get();
            }
        }

        $tipo_reporte = $request->tipo_reporte;

        if ($tipo_reporte == 'pdf') {
            $pdf = PDF::loadView('reportes.lista_solicitudes', compact('solicituds'))->setPaper('letter', 'landscape');
            // ENUMERAR LAS PÁGINAS USANDO CANVAS
            $pdf->output();
            $dom_pdf = $pdf->getDomPDF();
            $canvas = $dom_pdf->get_canvas();
            $alto = $canvas->get_height();
            $ancho = $canvas->get_width();
            $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

            return $pdf->stream('lista_solicitudes.pdf');
        } else {
            $spreadsheet = new Spreadsheet();
            $spreadsheet->getProperties()
                ->setCreator("Biblioteca")
                ->setLastModifiedBy('Administración')
                ->setTitle('Lista de solicitudes')
                ->setSubject('Lista de solicitudes')
                ->setDescription('Lista de solicitudes')
                ->setKeywords('PHPSpreadsheet')
                ->setCategory('Listado de solicitudes');

            $sheet = $spreadsheet->getActiveSheet();

            $spreadsheet->getDefaultStyle()->getFont()->setName('Arial');
            $styleArray = [
                'font' => [
                    'bold' => true,
                    'size' => 12
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ];
            $sheet->getStyle('B1:L1')->applyFromArray($styleArray);
            $spreadsheet->getDefaultStyle()->getFont()->setSize(10);
            // LLENADO DEL REPORTE
            $sheet->setCellValue('B1', 'SOLICITUD DE PRÉSTAMOS DE LIBROS');
            $sheet->mergeCells("B1:U1");  //COMBINAR CELDAS
            // ENCABEZADO
            $sheet->setCellValue('B2', 'Nº');
            $sheet->setCellValue('C2', 'LECTOR');
            $sheet->setCellValue('D2', 'LIBRO/REVISTA SOLICITUD');
            $sheet->setCellValue('E2', 'TIPO');
            $sheet->setCellValue('F2', 'AUTOR');
            $sheet->setCellValue('G2', 'EDICIÓN');
            $sheet->setCellValue('H2', 'EDITORIAL');
            $sheet->setCellValue('I2', 'VOLUMEN');
            $sheet->setCellValue('J2', 'FECHA SOLICITUD');
            $sheet->setCellValue('K2', 'OBSERVACIÓN');
            $sheet->setCellValue('L2', 'ESTADO');

            $styleArray = [
                'font' => [
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ];
            $sheet->getStyle('B2:L2')->applyFromArray($styleArray);

            // RECORRER LOS REGISTROS
            $nro_fila = 3;
            $cont = 1;
            foreach ($solicituds as $solicitud) {
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ];
                $sheet->getStyle('B' . $nro_fila . ':L' . $nro_fila)->applyFromArray($styleArray);

                $sheet->setCellValue('B' . $nro_fila, $cont++);
                $sheet->setCellValue('C' . $nro_fila, $solicitud->lector->nombre . ' ' . $solicitud->lector->apellidos);
                $sheet->setCellValue('D' . $nro_fila, $solicitud->libro->titulo);
                $sheet->setCellValue('E' . $nro_fila, $solicitud->libro->tipo);
                $sheet->setCellValue('F' . $nro_fila, $solicitud->libro->autor->nombre);
                $sheet->setCellValue('G' . $nro_fila, $solicitud->libro->edicion->nombre);
                $sheet->setCellValue('H' . $nro_fila, $solicitud->libro->editorial->nombre);
                $sheet->setCellValue('I' . $nro_fila, $solicitud->libro->volumen->nombre);
                $sheet->setCellValue('J' . $nro_fila, $solicitud->fecha_solicitud);
                $sheet->setCellValue('K' . $nro_fila, $solicitud->observacion);
                $sheet->setCellValue('L' . $nro_fila, $solicitud->estado_solicitud);
                $nro_fila++;
            }

            // AJUSTAR EL ANCHO DE LAS CELDAS
            foreach (range('B', 'L') as $columnID) {
                $sheet->getColumnDimension($columnID)
                    ->setAutoSize(true);
            }

            // DESCARGA DEL ARCHIVO
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="ListaSolicitudes.xlsx"');
            header('Cache-Control: max-age=0');
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
        }
    }

    public function lista_devoluciones(Request $request)
    {
        $filtro = $request->filtro;
        $fecha_ini = $request->fecha_ini;
        $fecha_fin = $request->fecha_fin;

        $devoluciones = Prestamo::where('descripcion', 'DEVOLUCION')
            ->where('estado', 1)
            ->get();

        if ($filtro == 'fecha') {
            if ($fecha_ini != '' && $fecha_fin != '') {
                $devoluciones = Prestamo::where('descripcion', 'DEVOLUCION')
                    ->whereBetween('fecha_registro', [$fecha_ini, $fecha_fin])
                    ->where('estado', 1)
                    ->get();
            }
        }

        $tipo_reporte = $request->tipo_reporte;

        if ($tipo_reporte == 'pdf') {
            $pdf = PDF::loadView('reportes.lista_devoluciones', compact('devoluciones'))->setPaper('letter', 'landscape');
            // ENUMERAR LAS PÁGINAS USANDO CANVAS
            $pdf->output();
            $dom_pdf = $pdf->getDomPDF();
            $canvas = $dom_pdf->get_canvas();
            $alto = $canvas->get_height();
            $ancho = $canvas->get_width();
            $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

            return $pdf->stream('ListaDevoluciones.pdf');
        } else {
            $spreadsheet = new Spreadsheet();
            $spreadsheet->getProperties()
                ->setCreator("Biblioteca")
                ->setLastModifiedBy('Administración')
                ->setTitle('Lista de devoluciones')
                ->setSubject('Lista de devoluciones')
                ->setDescription('Lista de devoluciones')
                ->setKeywords('PHPSpreadsheet')
                ->setCategory('Listado de devoluciones');

            $sheet = $spreadsheet->getActiveSheet();

            $spreadsheet->getDefaultStyle()->getFont()->setName('Arial');
            $styleArray = [
                'font' => [
                    'bold' => true,
                    'size' => 12
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ];
            $sheet->getStyle('B1:L1')->applyFromArray($styleArray);
            $spreadsheet->getDefaultStyle()->getFont()->setSize(10);
            // LLENADO DEL REPORTE
            $sheet->setCellValue('B1', 'LISTA DE DEVOLUCIONES DE LIBROS');
            $sheet->mergeCells("B1:I1");  //COMBINAR CELDAS
            // ENCABEZADO
            $sheet->setCellValue('B2', 'LIBRO/REVISTA DEVOLUCIÓN');
            $sheet->setCellValue('C2', 'LECTOR');
            $sheet->setCellValue('D2', 'TIPO');
            $sheet->setCellValue('E2', 'AUTOR');
            $sheet->setCellValue('F2', 'EDICIÓN');
            $sheet->setCellValue('G2', 'EDITORIAL');
            $sheet->setCellValue('H2', 'VOLUMEN');
            $sheet->setCellValue('I2', 'FECHA DEVOLUCUCIÓN');

            $styleArray = [
                'font' => [
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ];
            $sheet->getStyle('B2:I2')->applyFromArray($styleArray);

            // RECORRER LOS REGISTROS
            $nro_fila = 3;
            $cont = 1;
            foreach ($devoluciones as $devolucion) {
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ];
                $sheet->getStyle('B' . $nro_fila . ':I' . $nro_fila)->applyFromArray($styleArray);

                $sheet->setCellValue('B' . $nro_fila, $devolucion->libro->titulo);
                $sheet->setCellValue('C' . $nro_fila, $devolucion->lector->nombre . ' ' . $devolucion->lector->apellidos);
                $sheet->setCellValue('D' . $nro_fila, $devolucion->libro->tipo);
                $sheet->setCellValue('E' . $nro_fila, $devolucion->libro->autor->nombre);
                $sheet->setCellValue('F' . $nro_fila, $devolucion->libro->edicion->nombre);
                $sheet->setCellValue('G' . $nro_fila, $devolucion->libro->editorial->nombre);
                $sheet->setCellValue('H' . $nro_fila, $devolucion->libro->volumen->nombre);
                $sheet->setCellValue('I' . $nro_fila, $devolucion->fecha_registro);
                $nro_fila++;
            }

            // AJUSTAR EL ANCHO DE LAS CELDAS
            foreach (range('B', 'I') as $columnID) {
                $sheet->getColumnDimension($columnID)
                    ->setAutoSize(true);
            }

            // DESCARGA DEL ARCHIVO
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="ListaDevoluciones.xlsx"');
            header('Cache-Control: max-age=0');
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
        }
    }

    public function lista_estado(Request $request)
    {
        $filtro = $request->filtro;
        $area = $request->area;
        $estado = $request->estado;
        $portal = $request->portal;

        $libros = Libro::where('status', 1)->get();

        switch ($filtro) {
            case 'area':
                if ($area != 'todos') {
                    $libros = Libro::where('status', 1)
                        ->where('area_id', $area)->get();
                }
                break;
            case 'estado':
                if ($estado != 'todos') {
                    $libros = Libro::where('status', 1)
                        ->where('estado', $estado)->get();
                }
                break;
            case 'portal':
                if ($portal != 'todos') {
                    $libros = Libro::where('status', 1)
                        ->where('portal', $portal)->get();
                }
                break;
        }

        $tipo_reporte = $request->tipo_reporte;

        if ($tipo_reporte == 'pdf') {
            $pdf = PDF::loadView('reportes.lista_estado', compact('libros'))->setPaper('legal', 'landscape');
            // ENUMERAR LAS PÁGINAS USANDO CANVAS
            $pdf->output();
            $dom_pdf = $pdf->getDomPDF();
            $canvas = $dom_pdf->get_canvas();
            $alto = $canvas->get_height();
            $ancho = $canvas->get_width();
            $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

            return $pdf->stream('EstadoLibros.pdf');
        } else {
            $spreadsheet = new Spreadsheet();
            $spreadsheet->getProperties()
                ->setCreator("Biblioteca")
                ->setLastModifiedBy('Administración')
                ->setTitle('Lista de devoluciones')
                ->setSubject('Lista de devoluciones')
                ->setDescription('Lista de devoluciones')
                ->setKeywords('PHPSpreadsheet')
                ->setCategory('Listado de devoluciones');

            $sheet = $spreadsheet->getActiveSheet();

            $spreadsheet->getDefaultStyle()->getFont()->setName('Arial');
            $styleArray = [
                'font' => [
                    'bold' => true,
                    'size' => 12
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ];
            $sheet->getStyle('B1:V1')->applyFromArray($styleArray);
            $spreadsheet->getDefaultStyle()->getFont()->setSize(10);
            // LLENADO DEL REPORTE
            $sheet->setCellValue('B1', 'MOVIMIENTO DE LIBROS');
            $sheet->mergeCells("B1:V1");  //COMBINAR CELDAS
            // ENCABEZADO
            $sheet->setCellValue('B2', 'NRO. INV.');
            $sheet->setCellValue('C2', 'TÍTULO');
            $sheet->setCellValue('D2', 'ÁREA');
            $sheet->setCellValue('E2', 'AUTOR');
            $sheet->setCellValue('F2', 'EDICIÓN');
            $sheet->setCellValue('G2', 'VOLUMEN');
            $sheet->setCellValue('H2', 'LUGAR');
            $sheet->setCellValue('I2', 'EDITORIAL');
            $sheet->setCellValue('J2', 'AÑO');
            $sheet->setCellValue('K2', 'NRO. PÁGS.');
            $sheet->setCellValue('L2', 'ISBN');
            $sheet->setCellValue('M2', 'PROCEDENCIA');
            $sheet->setCellValue('N2', 'PRECIO');
            $sheet->setCellValue('O2', 'SIGNATURA');
            $sheet->setCellValue('P2', 'ESTADO');
            $sheet->setCellValue('Q2', 'TIPO');
            $sheet->setCellValue('R2', 'UBICACIÓN');
            $sheet->setCellValue('S2', 'PORTAL');
            $sheet->setCellValue('T2', 'OBSERVACIONES');
            $sheet->setCellValue('U2', 'FECHA REGISTRO');
            $sheet->setCellValue('V2', 'MOVIMIENTO');
            $styleArray = [
                'font' => [
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ];
            $sheet->getStyle('B2:V2')->applyFromArray($styleArray);

            // RECORRER LOS REGISTROS
            $nro_fila = 3;
            $cont = 1;
            foreach ($libros as $libro) {
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ];
                $sheet->getStyle('B' . $nro_fila . ':V' . $nro_fila)->applyFromArray($styleArray);

                $sheet->setCellValue('B' . $nro_fila, $cont++);
                $sheet->setCellValue('C' . $nro_fila, $libro->titulo);
                $sheet->setCellValue('D' . $nro_fila, $libro->area->nombre);
                $sheet->setCellValue('E' . $nro_fila, $libro->autor->nombre);
                $sheet->setCellValue('F' . $nro_fila, $libro->edicion->nombre);
                $sheet->setCellValue('G' . $nro_fila, $libro->volumen->nombre);
                $sheet->setCellValue('H' . $nro_fila, $libro->lugar->nombre);
                $sheet->setCellValue('I' . $nro_fila, $libro->editorial->nombre);
                $sheet->setCellValue('J' . $nro_fila, $libro->fecha_anio);
                $sheet->setCellValue('K' . $nro_fila, $libro->nro_paginas);
                $sheet->setCellValue('L' . $nro_fila, $libro->isbn);
                $sheet->setCellValue('M' . $nro_fila, $libro->procedencia);
                $sheet->setCellValue('N' . $nro_fila, $libro->precio);
                $sheet->setCellValue('O' . $nro_fila, $libro->signatura);
                $sheet->setCellValue('P' . $nro_fila, $libro->estado);
                $sheet->setCellValue('Q' . $nro_fila, $libro->tipo);
                $sheet->setCellValue('R' . $nro_fila, $libro->ubicacion->estante . ' - ' . $libro->ubicacion->balda);
                $sheet->setCellValue('S' . $nro_fila, $libro->portal);
                $sheet->setCellValue('T' . $nro_fila, $libro->observaciones);
                $sheet->setCellValue('U' . $nro_fila, $libro->fecha_registro);
                $sheet->setCellValue('V' . $nro_fila, $libro->prestamos->last()->tipo);
                $nro_fila++;
            }

            // AJUSTAR EL ANCHO DE LAS CELDAS
            foreach (range('B', 'V') as $columnID) {
                $sheet->getColumnDimension($columnID)
                    ->setAutoSize(true);
            }

            // DESCARGA DEL ARCHIVO
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="MovimientoLibros.xlsx"');
            header('Cache-Control: max-age=0');
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
        }
    }
}
