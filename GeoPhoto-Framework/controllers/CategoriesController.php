<?php
class CategoriesController extends BaseController {

    private $model;

    public function onInit(){
        $this->title = "Categories";
        $this->model = new CategoriesModel();
    }

    public function show(){
        $this->authorize();
        $this->categories = $this->model->getAll();
        $this->renderView(__FUNCTION__,true);
    }

    public function create(){
        $this->authorize();
        if($this->isPost()){
            $name = $_POST['category_name'];

            if($this->model->create($name)){
                $this->redirect('albums');
            }
            else{
                $this->addErrorMessage("The category is not created");
            }
        }
    }

    public function delete($id){
        $this->authorize();
        if($this->model->delete($id)){
            $this->redirect('albums');
        }
        else{
            $this->addErrorMessage('Can not delete the category');
        }
    }

    public function choose(){
        $this->authorize();
        $this->categories = $this->model->getAll();
        $this->renderView(__FUNCTION__,true);
    }


}