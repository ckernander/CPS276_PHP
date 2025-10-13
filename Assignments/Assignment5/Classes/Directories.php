<?php

class Directories
{
    private $basePath;
    public $message = '';
    public $link = '';
    public $dirname = '';
    public $filecontent = '';

    public function __construct()
    {
        $this->basePath = __DIR__ . '/../Directories/';
        $this->ensureBasePathExists(); // Make sure folder exists
    }

    public function handleRequest()
    {
        // If form was submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->dirname = strtolower(basename($_POST['dirname'] ?? ''));
            $this->filecontent = $_POST['filecontent'] ?? '';

            $result = $this->createDirectoryWithFile($this->dirname, $this->filecontent);

            if ($result['success']) {
                $this->link = '?view=' . urlencode($this->dirname);
            } else {
                $this->message = $result['message'];
            }
        }

        // If user clicked to view the file
        if (isset($_GET['view'])) {
            $this->serveReadme($_GET['view']);
        }
    }

    private function ensureBasePathExists()
    {
        if (!is_dir($this->basePath)) {
            mkdir($this->basePath, 0777, true); // Create if missing
        }
    }

    private function createDirectoryWithFile($dirname, $content)
    {
        if (!preg_match('/^[A-Za-z0-9]+$/', $dirname)) {
            return [
                'success' => false,
                'message' => 'Invalid directory name. Use alphanumeric characters only.'
            ];
        }

        $targetDir = $this->basePath . $dirname;

        if (is_dir($targetDir)) {
            return [
                'success' => false,
                'message' => 'A directory already exists with that name.'
            ];
        }

        if (!mkdir($targetDir, 0777, true)) {
            return [
                'success' => false,
                'message' => 'Failed to create directory (check permissions).'
            ];
        }

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

    private function serveReadme($dirname)
    {
        $dirname = strtolower(basename($dirname));

        if (!preg_match('/^[A-Za-z0-9]+$/', $dirname)) {
            echo "Invalid file path.";
            exit;
        }

        $filepath = $this->basePath . $dirname . '/readme.txt';

        if (file_exists($filepath)) {
            header('Content-Type: text/plain');
            readfile($filepath);
            exit;
        }

        echo "File not found.";
        exit;
    }
}