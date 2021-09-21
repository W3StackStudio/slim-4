<?php

namespace App\Controllers;

use App\Services\HomeService;
use App\Services\SmsService;
use App\Services\ImgService;
use Intervention\Image\ImageManagerStatic;

class HomeController
{
    /**
     * TODO index
     */
    public function home($request, $response)
    {
        $out = [];
        $response->getBody()->write(json_encode($out));
        return $response->withHeader('Content-Type', 'application/json');
    }

    /**
     * Todo Upload Editor image
     */
    // upload editor image
    public function uploadEditorImage($request, $response)
    {
        $out = [];

        $uploadedFiles = $request->getUploadedFiles();

        // handle single input with single file upload
        $uploadedFile = $uploadedFiles['UploadFiles'];
        if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
            $imageLibrary = new ImgService();
            $out['fileName'] = $imageLibrary->saveJournalFileImage($_FILES['UploadFiles']);
        }
        $response->getBody()->write(json_encode($out));
        return $response->withHeader('Content-Type', 'application/json');
    }

    // delete editor image
    public function deleteTextEditorImage($request, $response)
    {
        $out = [];

        $uploadedFiles = $request->getUploadedFiles();

        // handle single input with single file upload
        $uploadedFile = $uploadedFiles['UploadFiles'];
        if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
            $imageLibrary = new ImgService();
            $out = $imageLibrary->deleteDocImage($_FILES['UploadFiles']);
        }
        $response->getBody()->write(json_encode($out));
        return $response->withHeader('Content-Type', 'application/json');
    }

    /**
     * TODO Country List
     */
    public function countryList($request, $response)
    {
        $out = [];
        $params = $request->getQueryParams();
        $service = new HomeService();
        $out = $service->countryList();
        $response->getBody()->write(json_encode($out));
        return $response->withHeader('Content-Type', 'application/json');
    }
    /**
     * TODO State List
     */
    public function stateList($request, $response)
    {
        $out = [];
        $params = $request->getQueryParams();
        $service = new HomeService();
        $out = $service->stateList($params);
        $response->getBody()->write(json_encode($out));
        return $response->withHeader('Content-Type', 'application/json');
    }

    /**
     * TODO City List
     */
    public function cityList($request, $response)
    {
        $out = [];
        $params = $request->getQueryParams();
        $service = new HomeService();
        $out = $service->cityList($params);
        $response->getBody()->write(json_encode($out));
        return $response->withHeader('Content-Type', 'application/json');
    }

    /**
     * TODO Util Data
     */
    public function getUtilData($request, $response)
    {
        $out = [];
        $params = $request->getQueryParams();
        $service = new HomeService();
        if (array_key_exists('religion', $params) && $params['religion'] === 'true') {
            $out['religionList'] = $service->religionList();
        }
        if (array_key_exists('socialCategory', $params) && $params['socialCategory'] === 'true') {
            $out['socialCategoryList'] = $service->socialCategoryList();
        }
        $response->getBody()->write(json_encode($out));
        return $response->withHeader('Content-Type', 'application/json');
    }
    /**
     * TODO File System
     */
    public function getFileSystem($request, $response)
    {
        $out = [];
        $out['__DIR__'] = __DIR__;
        $out['__FILE__'] = __FILE__;
        $out['_SERVER'] = $_SERVER['SERVER_NAME'];
        $out['SERVER_DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT'];
        $response->getBody()->write(json_encode($out));
        return $response->withHeader('Content-Type', 'application/json');
    }
    /**
     * TODO Image Upload Test
     */
    public function imageUploadTest($request, $response)
    {
        $out = [];
        $path = $_SERVER['DOCUMENT_ROOT'] . '/assets/images/users/my_photo.jpg';
        $img = ImageManagerStatic::make('https://cdn.pixabay.com/photo/2020/07/21/10/52/girl-5425872_1280.jpg');
        $img->save($path, 50);
        $response->getBody()->write(json_encode($out));
        return $response->withHeader('Content-Type', 'application/json');
    }
    /**
     * TODO SMS Balance
     */
    public function smsBalance($request, $response)
    {
        $out = [];
        $service = new SmsService();
        $out = $service->checkBalance();
        $response->getBody()->write(json_encode($out));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
