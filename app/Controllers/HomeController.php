<?php

namespace App\Controllers;

use App\Models\Container;
use App\Helper\StorageHelper;
use Throwable;

class HomeController extends Action
{
    public function index(): void
    {
        try {
            $course = Container::getModel('Course');
            $this->view->dados = $course->getAll();
            $this->view('home/index', 'header');
        } catch (Throwable $e) {
            $status = "error";
            header("Location: /?feedback=$status&message=" . $e->getMessage());
        }
    }

    public function getCourse()
    {
        try {
            $id = $_GET['id'];
            header('Content-Type: application/json');

            $course = Container::getModel('Course');
            $courseData = $course->getById($id);

            $data = [
                'id' => $id,
                'title' => $courseData['title'],
                'description' => $courseData['description'],
                'banner' => $courseData['banner'],
            ];

            echo json_encode($data);
        } catch (Throwable $e) {
            echo json_encode(['error' => 'Course not found']);
        }
    }

    public function store(): void
    {
        try {
            $storageHelper = new StorageHelper();
            $course = Container::getModel('Course');
            $dirBanner = 'storage/banner-course/';
            $banner = $_FILES['banner'];

            if($_FILES['banner'])
            {
                $banner = $storageHelper->storage($banner, $dirBanner);
            }

            $course->__set('title', $_POST['title']);
            $course->__set('description', $_POST['description']);
            $course->__set('banner', $banner);
            $course->store();

            $status = 'success';
            header("Location: /?feedback=$status");
            exit;
        } catch (\Throwable $th) {
            $status = 'error';
            header("Location: /?feedback=$status");
        }
    }

    public function update(): void
    {
        $data = $_POST;
        $banner = $_FILES['banner'];
        $storageHelper = new StorageHelper();
        $course = Container::getModel('Course');
        $courseData = Container::getModel('Course')->getById($data['course_id']);
        $dirBanner = 'storage/banner-course/';

        // verificar se tem uma nova imagem
        if($banner['size'] != 0)
        {
            // localizar imagem atual
            $storageHelper->deleteFile($courseData['banner'], $dirBanner);
            $newBanner = $storageHelper->storage($banner, $dirBanner);
            $courseData['banner'] = $newBanner;
        }

        $course->__set('title', $_POST['title']);
        $course->__set('description', $_POST['description']);
        $course->__set('banner', $courseData['banner']);
        $course->update($data['course_id']);

        $status = 'success';
        header("Location: /?feedback=$status");
        exit;
    }
}