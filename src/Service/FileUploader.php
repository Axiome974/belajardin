<?php


namespace App\Service;

use App\Entity\EntityInterface\FileAttachableInterface;
use App\Entity\FileUploaded;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader{

    private $targetDirectory;
    private $slugger;
    /**
     * @var EntityManagerInterface
     */
    private $manager;
    private $uploadDirectory;

    /**
     * @param $targetDirectory
     * @param $uploadDirectory
     * @param SluggerInterface $slugger
     * @param EntityManagerInterface $manager
     */
    public function __construct($targetDirectory, $uploadDirectory, SluggerInterface $slugger, EntityManagerInterface $manager)
    {
        $this->targetDirectory = $targetDirectory;
        $this->slugger = $slugger;
        $this->manager = $manager;
        $this->uploadDirectory = $uploadDirectory;
    }

    public function upload(UploadedFile $file): FileUploaded
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($this->getTargetDirectory(), $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }
        $fileUploaded = new FileUploaded();
        $fileUploaded->setFilepath($this->uploadDirectory."/");
        $fileUploaded->setFile($fileName);
        $fileUploaded->setFilename($originalFilename);

        $this->manager->persist($fileUploaded);
        $this->manager->flush();

        return $fileUploaded;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory.$this->uploadDirectory;
    }

    public function attachFile( FileAttachableInterface $attachable, UploadedFile $uploadedFile ): FileAttachableInterface
    {

        $file = $this->upload($uploadedFile);
        $attachable->setFile($file);
        $this->manager->persist($attachable);
        $this->manager->flush();
        return $attachable;
    }

    public function detachFile( FileAttachableInterface $attachable ): FileAttachableInterface
    {
        $file = $attachable->getFile();
        unlink( $this->getTargetDirectory()."/".$file->getFile());

//        try{
//        }catch( \Exception $e){
//            dd("hola");
//        }
        $attachable->removeFile();
        $this->manager->remove($file);
        $this->manager->flush();
        return $attachable;
    }


}
