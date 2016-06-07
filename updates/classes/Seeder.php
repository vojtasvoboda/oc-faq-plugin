<?php namespace VojtaSvoboda\Faq\Updates\Classes;

use Exception;
use Seeder as BaseSeeder;
use System\Models\File;

class Seeder extends BaseSeeder
{
    /** @var string $seedFileName */
    protected $seedFileName;

    /** @var $cache Cache for all objects */
    private $cache;

    /**
     * Return dummy seed or resources seed
     *
     * @param $defaultPath
     *
     * @return string
     *
     * @throws Exception
     */
    protected function getSeedFile($defaultPath)
    {
        // if dummy file is overwritten
        $overwritterPath = $this->getOverwrittenFilePath($defaultPath);
        if (file_exists($overwritterPath)) {
            return $overwritterPath;
        }

        // otherwise return dummy data
        if (file_exists($defaultPath)) {
            return $defaultPath;
        }

        throw new Exception('Seed file ' . $this->seedFileName . ' not found!');
    }

    /**
     * Get item from cache or from $object reference
     *
     * @param $object
     * @param $key
     * @param $value
     *
     * @return mixed
     */
    protected function getCached($object, $key, $value, $createIfNotExists = false)
    {
        $namespace = get_class($object);
        $cache = $this->cache;
        if ( isset($cache[$namespace][$key][$value]) ) {
            return $cache[$namespace][$key][$value];
        }

        $item = $object::where($key, $value)->first();
        $this->cache[$namespace][$key][$value] = $item;

        // if not exists, create
        if ($createIfNotExists) {
            // TODO
            throw new \BadMethodCallException('createIfNotExists parameter is not implemented');
        }

        return $item;
    }

    /**
     * Get folder, where seed can be overwritten
     *
     * - default folder e.g. /plugins/vojtasvoboda/faq/updates/sources/messages.yaml
     * - overwritten e.g.  /resources/vojtasvoboda/faq/updates/sources/messages.yaml
     *
     * @param $defaultPath
     *
     * @return string
     */
    private function getOverwrittenFilePath($defaultPath)
    {
        return str_replace('plugins', 'resources', $defaultPath);
    }

    /**
     * Create file from path, save it and return File object
     *
     * @param $path
     * @param $public
     *
     * @return File
     */
    protected function getSavedFile($path, $public = true)
    {
        $file = new File();
        $file->is_public = $public;
        $file->fromFile($path);
        $file->save();

        return $file;
    }
}
