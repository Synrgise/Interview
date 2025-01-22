<?php

require_once "./fpdf/fpdf.php";
require_once "./database/models/Task.php";

function generate_pdf()
{
    try {
        $tasks = Task::get_all();
        $tasks = array_filter($tasks, function ($task) {
            return $task->published;
        });
        $pdf = new FPDF();
        $pdf->SetTitle('Completed Tasks');
        $pdf->AddPage();
        $pdf->Image('./assets/images/favicon.png', 10, 10, 10);
        $pdf->SetY(22);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->MultiCell(0, 6, 'Completed Tasks Report', 0, 1);
        $pdf->SetFont('Arial', '', 11);
        $pdf->MultiCell(0, 6, 'Generated at ' . (date_format(new DateTime(), 'd M, Y')), 0, 1);
        $pdf->Line(10, 40, 200, 40);
        $pdf->SetAutoPageBreak(true, 30);
        $pdf->SetY(42);
        foreach ($tasks as $i => $task) {
            $pdf->SetY($pdf->GetY() + 8);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->MultiCell(0, 10, $task->name, 0, 1);
            $pdf->SetFont('Arial', '', 11);
            $pdf->MultiCell(0, 8, $task->description, 0, 1);
            $pdf->MultiCell(0, 8, "Due Date: " . $task->due_date, 0, 1);
        }
        $pdf->Output();
    } catch (\Throwable $th) {
        var_dump($th);
    }
}


function generate_csv()
{
    try {
        $tasks = Task::get_all();
        $tasks = array_filter($tasks, function ($task) {
            return $task->published;
        });
        $filename = 'completed_tasks.csv';
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        $output = fopen('php://output', 'w');
        fputcsv($output, ['Task Name', 'Description', 'Due Date']);
        foreach ($tasks as $task) {
            fputcsv($output, [$task->name, $task->description, $task->due_date]);
        }
        fclose($output);
    } catch (\Throwable $th) {
        var_dump($th);
    }
}

$type = $_GET['type'] ?? 'pdf';

switch ($type) {
    case 'pdf':
        generate_pdf();
        break;
    case 'csv':
        generate_csv();
        break;
    default:
        break;
}
