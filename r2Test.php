<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use Shadcn\Shadcn;

require_once 'vendor/autoload.php';

// Cloudflare R2 Storage Client
$r2 = new R2\Client([
    'accountId' => 'your-account-id',
    'accessKeyId' => 'your-access-key-id',
    'accessKeySecret' => 'your-access-key-secret',
    'bucket' => 'your-bucket-name',
]);

// Whisper Model URL (local installation)
$whisperModelUrl = 'http://localhost:8080/whisper-model';

// Set up Guzzle HTTP client
$client = new Client();

// Shadcn UI interface
$shadcn = new Shadcn([
    'title' => 'File Upload to R2 Storage',
    'description' => 'Upload files to your RingCentral R2 storage using Whisper AI model.',
]);

?>

<!-- Shadcn UI interface -->
<?= $shadcn->begin() ?>

<form id="file-upload-form">
    <input type="file" id="file-upload" />
    <button type="submit">Upload File</button>
</form>

<!-- End of Shadcn UI interface -->

<?php
// Handle file upload
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    try {
        // Upload file to R2 storage using Whisper AI model
        $response = $client->post($whisperModelUrl, [
            'headers' => ['Content-Type' => 'audio/wav'],
            'body' => fopen($file['tmp_name'], 'rb'),
        ]);
        if ($response->getStatusCode() === 201) {
            echo 'File uploaded successfully!';
        } else {
            echo 'Error uploading file!';
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>

<!-- End of PHP script -->