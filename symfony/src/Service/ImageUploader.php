<?php

declare(strict_types=1);

namespace App\Service;


use Imagine\Image\Box;
use Imagine\Imagick\Imagine;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class ImageUploader
{
    public const MAX_IMAGE_WIDTH = 972;

    public function __construct(
        private string $uploadDirectory,
        private SluggerInterface $slugger
    ) {
    }

    public function upload(UploadedFile $file): string
    {
        $originalImageName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $newImageName = $this->slugger->slug($originalImageName) . '-' . uniqid() . '.' . $file->guessExtension();

        try {
            $file->move($this->uploadDirectory, $newImageName);

            $imagine = new Imagine();
            $image = $imagine->open($this->uploadDirectory . '/' . $newImageName);
            $imageSize = $image->getSize();

            $newWidth = self::MAX_IMAGE_WIDTH;
            $newHeight = ceil($imageSize->getHeight() / ($imageSize->getWidth() / $newWidth));

            $image->resize(new Box($newWidth, $newHeight));
            $image->save();

            return $newImageName;
        } catch (FileException $e) {
            return '';
        }
    }
}
