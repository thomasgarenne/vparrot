<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use Psr\Log\LoggerInterface;

class PictureService
{
    const UPLOAD_DIRECTORY = 'uploads/cars';

    public function __construct(
        private SluggerInterface $slugger,
        private LoggerInterface $logger,
    ) {
    }

    public function upload(UploadedFile $file): string
    {
        //$authorizedMimeTypes = ['image/png', 'image/jpeg'];

        // if (in_array($file->getClientMimeType(), $authorizedMimeTypes)) {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();

        try {
            $file->move(self::UPLOAD_DIRECTORY, $fileName);
        } catch (FileException $e) {
            // Log l'erreur
            $this->logger->error('Erreur lors du téléchargement du fichier: ' . $e->getMessage());

            // Remonter l'exception (si nécessaire)
            throw $e;
        }

        return $fileName;
        /* } else {
            // Le type de fichier n'est pas autorisé
            // Ajoutez cette ligne pour déboguer le type MIME
            dump($file->getClientMimeType());

            throw new \InvalidArgumentException('Type de fichier non autorisé.');
        }
        */
    }
}
