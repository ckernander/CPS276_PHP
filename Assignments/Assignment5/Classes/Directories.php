<?php

//Explain the benefits of organizing file and directory operations into a class structure. How does this approach improve code organization,
//reusability, and maintainability compared to writing all operations in procedural code?

class Directories
{
    private $basePath;
    public $message = '';
    public $link = '';
    public $dirname = '';
    public $filecontent = '';

    public function __construct(){
        $this->basePath = __DIR__ . '/../Directories/';
        $this->ensureBasePathExists();
    }
//Describe the flow of data from an HTML form submission to PHP processing.
//How does PHP access form data, and what considerations should developers keep in mind when handling user input from forms?
    public function handleRequest(){
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

        if (isset($_GET['view'])) {
            $this->serveReadme($_GET['view']);
        }
    }

    private function ensureBasePathExists()
    {
        if (!is_dir($this->basePath)) {
            mkdir($this->basePath, 0777, true);
        }
    }


//Explain the difference between creating a directory and creating a file in PHP.
//What PHP functions are used for each operation, and why is it important to check if a directory already exists before attempting to create it?
    private function createDirectoryWithFile($dirname, $content){
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

//Why did we use 777 permissions and what should we use and why?
        if (!mkdir($targetDir, 0777, true)) {
            return [
                'success' => false,
                'message' => 'Failed to create directory (check permissions).'
            ];
        }

        $filePath = $targetDir . '/readme.txt';

// Why is it important to properly close file handles after writing to files? What problems can occur if file
// handles are not closed, and how does this relate to system resource management?
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

    private function serveReadme($dirname){
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