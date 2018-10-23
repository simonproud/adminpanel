<?php

namespace Modules\Import\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Importer;

class ImportFiles implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected  $file;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file, $info)
    {
        $this->file = $file;
        $this->info = $info;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $importer = Importer::make('Csv');
        $importer->load($this->file);
        $collection = $importer->getCollection()->toArray();

         foreach ($collection as $key=>$collect){
              $str = explode('|', $collect[0]);
              if($key == 0){
                  continue;
              }else{
                  print_r($str);
              }

break;
          }
    }
}
