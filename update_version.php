<?php
/**
 * Simple PHP script to update the version number in version.txt
 * Türkçe Açıklama: Bu PHP betiği, version.txt dosyasındaki versiyon numarasını güncellemek için tasarlanmıştır.
 * Author: Ubden Community
 */

define('VERSION_FILE', __DIR__ . '/../version.txt'); // Dosya yolunuzu doğru ayarlayın, update_version.php dir'den (..) ile bir üst klk

function updateVersion() {
    if (file_exists(VERSION_FILE)) {
        $version = file_get_contents(VERSION_FILE);
        $version = trim($version);

        if (preg_match('/^\d+(\.\d+)*$/', $version)) {
            $parts = explode('.', $version);

            // Increment the last part
            $parts[count($parts) - 1]++;
            $new_version = implode('.', $parts);

            file_put_contents(VERSION_FILE, $new_version);

            echo "Version updated to: $new_version\n";
        } else {
            echo "Current version format is incorrect.\n";
        }
    } else {
        echo "Version file does not exist.\n";
    }
}

updateVersion();

?>