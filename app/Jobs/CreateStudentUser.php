<?php

namespace App\Jobs;

use App\Models\Eleve;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateStudentUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private $data, private $eleveService)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        $eleve = $this->eleveService->eleveExiste($this->data);
        if (is_null($eleve)) {
            $classe = $this->eleveService->classeExiste($this->data);
            if (isset($classe)) {

                $parent = $this->eleveService->parentExiste($this->data);
                if (isset($parent)) {

                    $eleve = Eleve::create($this->data);
                    $eleve->classe()->associate($classe['id']);
                    $eleve->userParent()->associate($parent['id'])->save();
                }
            }
        }
        
    }
}
