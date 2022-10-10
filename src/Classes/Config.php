<?php

declare(strict_types=1);

namespace Hexhat\Coins;

use function Hexhat\Coins\Library\findEnvVar;

class Config
{
    public function __construct(/* array $options = [] */)
    {
        // $this->options = array_merge(self::OPTIONS, $options);

        $configPathXDG = findEnvVar('XDG_CONFIG_HOME');
        $homeDir = findEnvVar('HOME');

        // Build all possible config's paths
        $this->configPaths = [
            // Actual paths
            $configPathXDG . '/coins/coins.conf',
            $homeDir . '/.config/coins/coins.conf',
            // Fixture's conf (for tests)
            __DIR__ . '/../../../tests/fixtures/coins.conf',
            __DIR__ . '/../tests/fixtures/coins.conf',
            __DIR__ . '/tests/fixtures/coins.conf',
            'tests/fixtures/coins.conf'
        ];
    }

    public function getConfig(): \stdClass
    {
        foreach ($this->configPaths as $path) {
            if (file_exists($path)) {
                $parse = parse_ini_file($path, true);
                $array = $this->moveAssetsOneLevelDeeper($parse);
                $array = $this->generateIdListField($array);
                return $this->convertToObject($array);
            }
        }
        echo "Can't find config file. Tried these paths:\n";
        print_r($this->configPaths);
        exit(1);
    }

    // TODO for future --tests flag (TODO same for sorts for --report)
    //private const OPTIONS = [
    //    'tests' => false
    //];

    //private array $options;
    private array $configPaths;

    private function moveAssetsOneLevelDeeper(array $array): array
    {
        $result = [];
        foreach ($array as $key => $value) {
            if (gettype($key) === 'integer') {
                $result['assets'][$key] = $value;
            } else {
                $result[$key] = $value;
            }
        }
        return $result;
    }

    private function generateIdListField(array $array): array
    {
        $result = '';
        foreach ($array['assets'] as $id => $value) {
            $result .= "{$id},";
        }
        $array['idlist'] = substr_replace($result, "", -1);
        return $array;
    }

    private function convertToObject(array $array): \stdClass
    {
        return json_decode(json_encode($array), false);
    }
}
