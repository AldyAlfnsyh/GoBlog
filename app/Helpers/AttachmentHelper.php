<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;


class AttachmentHelper{
    public static function deleteUnusedAttachments($oldBody, $newBody){
        // Ambil semua file lama
        preg_match_all('/src="([^"]+)"/', $oldBody ?? '', $oldMatches);
        $oldFiles = $oldMatches[1] ?? [];

        // Ambil semua file baru
        preg_match_all('/src="([^"]+)"/', $newBody ?? '', $newMatches);
        $newFiles = $newMatches[1] ?? [];

        // Cari file lama yang udah gak ada di body baru
        $filesToDelete = array_diff($oldFiles, $newFiles);

        foreach ($filesToDelete as $fileUrl){
            $path = str_replace(asset('storage'). '/', '', $fileUrl);
            Storage::disk('public')->delete($path);
        }
    }

    public static function deleteAllAttachments($body){
        preg_match_all('/src="([^"]+)"/', $body ?? '', $matches);
        $files =$matches[1] ?? [];

        foreach($files as $fileUrl){
            $path = str_replace(asset('storage').'/','',$fileUrl);
            Storage::disk('public')->delete($path);
        }
    }
}
