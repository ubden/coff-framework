<?php

// Coff PHP Framework
// Created by Ubden Community
// GitHub: https://github.com/ubden/coff-framework
// Contributors: https://github.com/ck-cankurt
// License: GNU GENERAL PUBLIC LICENSE
// Framework Website: https://coff.dev
// Sponsored Website: https://ubden.com
// Version: ubden/coff-framework/version.txt
// Release Date: 2024

namespace App\Includes;

class FileCache {
    protected $cachePath;

    public function __construct($cachePath = __DIR__ . '/../../cache/') {
        $this->cachePath = $cachePath;
        if (!file_exists($this->cachePath)) {
            mkdir($this->cachePath, 0777, true);
        }
    }

    public function set($key, $value, $expire = 3600) {
        $file = $this->cachePath . sha1($key) . '.cache';
        $data = serialize([
            'expires' => time() + $expire,
            'data' => $value
        ]);
        file_put_contents($file, $data);
    }

    public function get($key) {
        $file = $this->cachePath . sha1($key) . '.cache';
        if (file_exists($file)) {
            $cache = unserialize(file_get_contents($file));
            if ($cache['expires'] > time()) {
                return $cache['data'];
            } else {
                unlink($file);
            }
        }
        return null;
    }

    public function clear() {
        $files = glob($this->cachePath . '*.cache');
        foreach ($files as $file) {
            unlink($file);
        }
    }
}
