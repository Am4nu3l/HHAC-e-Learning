<?php
require 'vendor/autoload.php'; // Include the Composer autoload file
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Storage;

try {
    //Load the service account JSON file
    $factory = (new Factory)->withServiceAccount(__DIR__ . '/script/serviceAccountKey.json');
    $databaseURL = 'https://binipro-ee596-default-rtdb.firebaseio.com';
    $firebase = $factory->withDatabaseUri($databaseURL)->createDatabase();
    // Now you can interact with Firebase services using the $firebase object
    $reference = $firebase->getReference('student');
    $data = $reference->getValue();

    if ($data !== null) {
        print_r($data);
        echo $data['id'];
    } else {
        echo "No data found at the specified path.";
    }
} catch (\Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}
// Load the service account JSON file
$factory = (new Factory)->withServiceAccount(__DIR__ . '/serviceAccountKey.json');

// Create a Firebase Storage instance
$storage = $factory->createStorage();

// Specify the bucket name
$bucket = $storage->getBucket();

// Path to the local file you want to upload
$localFilePath = '/images/bg.png';

// Destination path in Firebase Cloud Storage
$destinationPath = 'gs://binipro-ee596.appspot.com/images';

// Upload the file
$bucket->upload(
    file_get_contents($localFilePath),
    ['name' => $destinationPath]
);
echo 'File uploaded successfully';
?>




