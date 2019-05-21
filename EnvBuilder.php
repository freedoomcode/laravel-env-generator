<?php

namespace AutoGenerator;


class EnvBuilder
{
    protected $config = [
        'dev' => [
            'DB_HOST' => '127.0.0.1',
            'DB_DATABASE' => 'laravel',
            'DB_USERNAME' => 'root',
            'DB_PASSWORD' => '123456',
        ],
        'uat' => [
            'DB_HOST' => '127.0.0.1',
            'DB_DATABASE' => 'laravel',
            'DB_USERNAME' => 'root',
            'DB_PASSWORD' => '123456',
        ]
    ];

    protected $envFilename = '.env';

    public function build($feature = 'dev', $scope = 'mouse')
    {
        $parameter = $this->load();
        $this->fillCustomOptions($parameter, $feature);
        $this->fillScope($parameter, $scope);
        $this->putContents($parameter, base_path(), $this->envFilename);
        return $this->envFilename;
    }

    protected function load($path = '', $filename = '.env.example')
    {
        $parameter = array();
        $lines = file(($path ? $path : base_path()) . DIRECTORY_SEPARATOR . $filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            // Disregard comments
            if (strpos(trim($line), '#') === 0) {
                continue;
            }
            // Only use non-empty lines that look like setters
            if (strpos($line, '=') !== false) {
                $position = strpos($line, '=');
                $key = substr($line, 0, $position);
                $value = substr($line, $position + 1);
                $parameter[$key] = $value;
            }
        }
        return $parameter;
    }

    protected function fillCustomOptions(&$parameter = [], $option = 'dev')
    {
        switch ($option) {
            case 'dev':
                $parameter = array_merge($parameter, $this->config[$option]);
                break;
            case 'uat':
                $parameter = array_merge($parameter, $this->config[$option]);
                break;
            default:
                $parameter = array_merge($parameter, $this->config['dev']);
        }
    }

    protected function fillScope(&$parameter = [], $scope = 'mouse')
    {
        $parameter = array_map(function ($value) use ($scope) {
            return str_replace('{{SCOPE}}', $scope, $value);
        }, $parameter);
    }

    protected function putContents($parameter = [], $path = '', $filename = '.env')
    {
        $path = $path ? $path : base_path();
        $contents = '# auto generate env file by chester.' . PHP_EOL . PHP_EOL;
        foreach ($parameter as $key => $value) {
            $contents .= $key . '=' . $value . PHP_EOL;
        }
        $contents .= '# done.' . PHP_EOL;
        file_put_contents($path . DIRECTORY_SEPARATOR . '.env.backup', file_get_contents($path . DIRECTORY_SEPARATOR . $filename));
        file_put_contents($path . DIRECTORY_SEPARATOR . $filename, $contents);
    }


}