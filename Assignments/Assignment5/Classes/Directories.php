<?php

class Directories
{
    private $basePath;

    public function __construct(){
        $this->basePath = __DIR__ . '/../Directories/';
    }

    public function createDirectoryWithFile($dirname, $content){
        if (!preg_match('/^[A-Za-z0-9]+$/', $dirname)) {
            return [
                'success' => false,
                'message' => 'Invalid directory name. Use letters only.'
            ];
        }

        $targetDir = $this->basePath . $dirname;

        // Check if directory already exists
        if (is_dir($targetDir)) {
            return [
                'success' => false,
                'message' => 'A directory already exists with that name.'
            ];
        }

        // Try to create directory
        if (!mkdir($targetDir, 0777, true)) {
            return [
                'success' => false,
                'message' => 'Failed to create directory.'
            ];
        }

        // Try to create readme.txt file
        $filePath = $targetDir . '/readme.txt';
        if (file_put_contents($filePath, $content) === false) {
            return [
                'success' => false,
                'message' => 'Failed to create readme.txt file.'
            ];
        }

        return [
            'success' => true,
            'message' => 'Directory and file created successfully.'
        ];
    }
}