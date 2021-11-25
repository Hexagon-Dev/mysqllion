<?php

namespace App\Jobs;

use App\Models\Data;
use App\Models\ExportQuery;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class ProcessQuery implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $id;

    /**
     * Create a new job instance.
     *c
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
     */
    public function handle(): void
    {
        ini_set('max_execution_time', 300);
        $query = ExportQuery::query()->find($this->id);

        if (!$query) {
            return;
        }

        $query->update([
            'status' => ExportQuery::STATUS_PROCESSING,
        ]);

        $size = Data::query()->count();

        $header = [
            'id',
            'login',
            'email',
            'address',
            'name',
            'occupation',
            'skill',
            'school',
            'degree',
            'food',
            'color'
        ];

        $started = now();

        $writer = WriterEntityFactory::createCSVWriter();

        $writer->openToFile($this->id . '.csv');

        $rowFromValues = WriterEntityFactory::createRowFromArray($header);
        $writer->addRow($rowFromValues);

        Data::query()->chunk(1000, function (Collection $chunk) use ($writer) {
            $rows = [];
            $chunk->each(function(Data $item) use (&$rows) {
                $rows[] = WriterEntityFactory::createRowFromArray($item->toArray());
            });
            $writer->addRows($rows);
        });

        $writer->close();

        $elapsed = now()->diffInSeconds($started);

        $query->update([
            'status' => ExportQuery::STATUS_DONE,
            'elapsed' => $elapsed,
        ]);
    }
}
