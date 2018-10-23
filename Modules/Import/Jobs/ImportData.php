<?php

namespace Modules\Import\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Import\Jobs\ImportFiles as ImportJobs;


class ImportData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $import;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($import)
    {
        $this->import = json_decode($import, true);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $import = $this->import;
        if(!is_dir('/var/www/imports/'.$import['id'].'/')){
            if (!mkdir('/var/www/imports/'.$import['id'].'/', 0777, true)) {
                die('Не удалось создать директории...');
            }
        }
        $files = $this->parceFile($import['main_filename'], 50, '/var/www/imports/'.$import['id'].'/');
       foreach ($files as $file){
            ImportJobs::dispatch($file, $import);

        }


    }

    public function parceFile($filename,$sizeporcii,$mask)
    {
        $files = [];
        $file=file($filename);
        $countporcii=intval(ceil(count($file)/$sizeporcii));



        for ($i=0;$i<$countporcii-1;$i++)
        {

            $firstarr = array(  trim($file[($i+1)*$sizeporcii-1])  );
            $secondarr = array_slice($file,$sizeporcii*$i,($sizeporcii-1));
            $fulldata =   array_merge($firstarr, $secondarr);
            file_put_contents($mask.($i+1).'.txt',  $fulldata);
            $files[] = $mask.($i+1).'.txt';


        }
        return $files;
    }
}
