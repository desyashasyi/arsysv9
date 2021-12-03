<?php

namespace Modules\Office\Http\Livewire\Letter\Research\Clerk;

use Livewire\Component;
use Modules\Office\Entities\AcademicYear;
use Modules\Office\Entities\Research;
use Livewire\WithPagination;
use PDF;

class Assignment extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refreshResearchAssignmentLetter_Clerk' => '$refresh'];
    public function render()
    {
        $academicYear = AcademicYear::latest()->first();
        $researchs = Research::where('academic_year_id', $academicYear->id)
            ->where('approval_date', '>', $academicYear->start)->paginate(25);
        return view('office::livewire.letter.research.clerk.assignment', compact('researchs', 'academicYear'));
    }

    public function printDraft(){
            $pdf = PDF::loadview('office::livewire.print.research.assignment-letter')
                        ->setPaper('a4', 'landscape');

            return response()->streamDownload(function () use($pdf) {
                echo  $pdf->stream();
            }, 'invoice.pdf');
    }

    

    public function printFinal(){
            /* Set the PDF Engine Renderer Path */
            $domPdfPath = base_path('vendor/dompdf/dompdf');
            \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
            \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');
             
            //Load word file
            $Content = \PhpOffice\PhpWord\IOFactory::load(public_path('result.docx')); 
     
            //Save it into PDF
            $PDFWriter = \PhpOffice\PhpWord\IOFactory::createWriter($Content,'PDF');
            $PDFWriter->save(public_path('new-result.pdf')); 
            session()->flash('success','The file has been converted');

            
    }
}
