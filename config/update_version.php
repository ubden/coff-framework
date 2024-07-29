<?php
// Hata görüntülemeyi aç
error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * Simple PHP script to update the version number in version.txt based on directory hash changes
 * Türkçe Açıklama: Bu PHP betiği, dizindeki değişikliklere göre versiyon.txt dosyasını günceller.
 * Author: Ubden Community
 */

define('VERSION_FILE', __DIR__ . '/../config/version.txt');  // Versiyon dosyasının konumu
define('SHA_FILE', __DIR__ . '/../config/version.sha');      // SHA değer dosyasının konumu
define('TARGET_DIR', __DIR__ . '/..');                       // Klasör yolu

/**
 * Dizindeki dosyaların SHA1 hash değerini hesaplayan fonksiyon
 */
function getDirectoryHash($directory) {
    if (!is_dir($directory)) {
        return array(); // Bir dizi döndür
    }

    $files = array();
    $dir = dir($directory);

    while (false !== ($entry = $dir->read())) {
        if ($entry != '.' && $entry != '..') {
            if (is_dir($directory . '/' . $entry)) {
                $files = array_merge($files, getDirectoryHash($directory . '/' . $entry)); // Her zaman dizi döndür
            } else {
                $files[] = $directory . '/' . $entry;
            }
        }
    }
    $dir->close();

    sort($files); // Dosyaları sıralıyoruz ki aynı dosyaların hash'i aynı olsun
    $hash = '';

    foreach ($files as $file) {
        // Eğer dosya yoksa hata almamak için kontrol ediyoruz
        if (file_exists($file) && is_file($file)) {
            $hash .= hash_file('sha1', $file);
        } else {
            echo "Warning: $file does not exist or is not a file.\n";
        }
    }

    return sha1($hash); // Sabit bir dize dönmek array array_merge hatasını ifmlaminas olabilir
}

/**
 * Versiyon güncelleme fonksiyonu
 */
function updateVersion() {
    if (!file_exists(VERSION_FILE)) {
        echo "Version file does not exist.\n";
        return;
    }

    if (!file_exists(SHA_FILE)) {
        file_put_contents(SHA_FILE, '');
    }

    $current_sha = getDirectoryHash(TARGET_DIR);
    $saved_sha = trim(file_get_contents(SHA_FILE));

    if ($current_sha === false) {
        echo "Directory hash calculation failed.\n";
        return;
    }

    // Debug point - Logging hashes for debugging
    echo "Current SHA: $current_sha\n";
    echo "Saved SHA: $saved_sha\n";

    if ($current_sha !== $saved_sha) {
        // SHA değişmiş, versiyonu güncelle
        $version = file_get_contents(VERSION_FILE);
        $version = trim($version);

        if (preg_match('/^\d+(\.\d+)*$/', $version)) {
            $parts = explode('.', $version);

            // Increment the last part
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