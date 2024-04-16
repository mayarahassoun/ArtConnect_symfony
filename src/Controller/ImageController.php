<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ImageController extends AbstractController
{
    public function display(string $imagePath): Response
    {
        // Assuming $imagePath contains the absolute file path
        $imageFilePath = $imagePath;
        // Check if the file exists
        if (!file_exists($imageFilePath)) {
            throw $this->createNotFoundException('The image file does not exist.');
        }

        // Create and return a BinaryFileResponse
        return new BinaryFileResponse($imageFilePath);
    }
}
