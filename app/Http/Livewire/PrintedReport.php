<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

use App\Models\HeadReport;

class PrintedReport extends Component
{
    use WithFileUploads;

    public $headReport;
    public $maintenance_type;
    public $fileName; // display

    public $reports = []; //user input

    //* user input
    public $attachments = []; //user input

    //* LIVEWIRE METHOD
    /**
     * run after class mount method.
     * if $id exist, then it must be an edit form.
     * init data if edit, init from class variable.
     * or else init expert arr key with empty value.
     *
     * @param $id OPTIONAL head_id of the current record
     */
    public function mount()
    {
        if (empty($this->reports)) {
            foreach ($this->headReport->printedReports as $printedReport) {
                $this->reports[] = ['fileName' => $printedReport->file, 'uploaded' => 1];
            }
        } else {
        //images mount
        $this->attachments = [
                ['fileName' => '', 'uploaded' => 0]
            ];
        }
    }

    /**
     * check if file isnt image type, then
     * remove the value so it will fail in validation.
     * only evaluate the image input
     *
     * @param $value value of the updated model
     * @param $index updated nested variable // eg. 0.images | 0.caption
     */
    // public function updatedAttachments($value, $index)
    // {
    //     $index = explode(".",$index); // 0.images
    //     if ($index[1] == 'image') {
    //         $extension = pathinfo($value->getFilename(), PATHINFO_EXTENSION);
    //         if (!in_array($extension, ['jpg', 'jpeg', 'png', 'bmp', 'gif', 'svg', 'webp'])) {
    //             $this->attachments[$index[0]]['image'] = '';
    //         }
    //         $this->validateUploads();
    //     }
    // }

    //* attachment method
    /**
     *
     */
    public function addReport()
    {
        $this->reports[] = ['fileName' => '', 'uploaded' => 0];
    }
    
    /**
     * if file already uploaded, first delete it from storage.
     * secondly, delete it from db record, and finaly set the upload
     * to zero. and regardless if it uploaded or not, delete the arr index.
     *
     * @param $index index of the current item
     */
    public function removeReport($index)
    {
        if (array_key_exists($index, $this->reports)) {
            if ($this->reports[$index]['uploaded'] === 1) {
                \Storage::delete('public/'.$this->headReport->printedReport->file);
                $this->headReport->printedReports()->delete();
                $this->reports[$index]['uploaded'] = 0;
            }
            
            unset($this->reports[$index]);
            array_values($this->reports);
            $this->emit('unsetReports');
        }
    }

    /**
     * validate every single file that are not uplaoded
     */
    public function validateUploads()
    {
        foreach ($this->reports as $index => $report) {
            if ($this->reports[$index]['uploaded'] == 0) {
                $this->validate([
                    'reports.'.$index.'.fileName' => 'required|mimes:pdf'
                ]);
            }
        }
    }

    /**
     * if it is not uploaded, store the file in
     * storage with default laravel file naming. then,
     * save the record to db and set teh uploaded value to one.
     */
    public function store()
    {
        $this->validateUploads();
        
        foreach ($this->reports as $index => $report) {
            if ($this->reports[$index]['uploaded'] == 0) {
                $fileName[$index] = $this->reports[$index]['fileName']->storePublicly($this->maintenance_type, 'public');
        
                $this->headReport->printedReport()->create([
                    'head_id' => $this->headReport->head_id,
                    'file' => $fileName[$index],
                ]);
                
                $this->reports[$index]['fileName'] = $fileName[$index];
                $this->reports[$index]['uploaded'] = 1;
            }
        }
    }

    public function render()
    {
        return view('livewire.printed-report');
    }
}
