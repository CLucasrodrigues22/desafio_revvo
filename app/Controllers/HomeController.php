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
}