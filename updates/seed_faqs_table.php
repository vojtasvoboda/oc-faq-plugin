<?php namespace VojtaSvoboda\Faq\Updates;

use File;
use VojtaSvoboda\Faq\Models\Faq;
use VojtaSvoboda\Faq\Updates\Classes\Seeder;
use Yaml;

class SeedFaqsTable extends Seeder
{
    protected $seedFileName = '/faqs.yaml';

    protected $seedDirPath = '/sources';

    public function run()
    {
        $defaultSeed = __DIR__ . $this->seedDirPath . $this->seedFileName;
        $seedFile = $this->getSeedFile($defaultSeed);
        $items = Yaml::parse(File::get($seedFile));

        foreach ($items as $key => $item) {
            Faq::create($item);
        }
    }
}
