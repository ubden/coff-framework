<?php
// Hata görüntülemeyi aç
error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * Simple PHP script to update the version number in version.txt based on directory hash changes
 * Türkçe Açıklama: Bu PHP betiği, dizindeki değişikliklere göre versiyon.txt dosyasını günceller.
 * Author: Ubden Community
 */

// Adjust these paths according to your directory structure
define('VERSION_FILE', __DIR__ . '/../version.txt');  // Versiyon dosyasının konumu
define('SHA_FILE', __DIR__ . '/../version.sha');      // SHA değer dosyasının konumu
define('TARGET_DIR', __DIR__ . '/..');                       // Klasör yolu

// Check if the paths are correctly set
echo "Current directory: " . __DIR__ . "\n";
echo "Version file path: " . VERSION_FILE . "\n";
echo "SHA file path: " . SHA_FILE . "\n";
echo "Target directory: " . TARGET_DIR . "\n";

function getDirectoryHash($directory) {
    if (!is_dir($directory)) {
        return []; // bir array dönmek ifdir değilse eklenmiştir
    }

    $files = [];
    $dir = dir($directory);

    while (false !== ($entry = $dir->read())) {
        if ($entry != '.' && $entry != '..') {
            if (is_dir($directory . '/' . $entry)) {
                $sub_dir_files = getDirectoryHash($directory . '/' . $entry); // salário sub me
                if (is_array($sub_dir_files)){
                    $files = array_merge($files, $sub_dir_files); // Hala array merge
                }
            } else {
                $files[] = $directory . '/' . $entry;
            }
        }
    }
    $dir->close();

    sort($files);
    $hash = '';

    foreach ($files as $file) {
        if (file_exists($file) && is_file($file)) {
            $hash .= hash_file('sha1', $file);
        } else {
            echo "Warning: $file does not exist or is not a file.\n";
        }
    }

    return $hash === '' ? [] : [sha1($hash)]; // boş string dönmemesi için check yaparkaşu [] focus arrayygur)
}

function updateVersion() {
    if (!file_exists(VERSION_FILE)) {
        echo "Version file does not exist.\n";
        return;
    }

    if (!file_exists(SHA_FILE)) {
        file_put_contents(SHA_FILE, '');
    }

    $current_sha = getDirectoryHash(TARGET_DIR)[0] ?? '';
    $saved_sha = trim(file_get_contents(SHA_FILE));

    if ($current_sha === false) {
        echo "Directory hash calculation failed.\n";
        return;
    }

    echo "Current SHA: $current_sha\n";
    echo "Saved SHA: $saved_sha\n";

    if ($current_sha !== $saved_sha) {
        $version = file_get_contents(VERSION_FILE);
        $version = trim($version);

        if (preg_match('/^\d+(\.\d+)*$/', $version)) {
            $parts = explode('.', $version);
            $parts[count($parts) - 1]++;
            $new_version = implode('.', $parts);

            file_put_contents(VERSION_FILE, $new_version);
            file_put_contents(SHA_FILE, $current_sha);

            echo "Version updated to: $new_version\n";
        } else {
            echo "Current version format is incorrect.\n";
        }
    } else {
        echo "No changes detected. Version remains unchanged.\n";
    }
}

updateVersion();
?>