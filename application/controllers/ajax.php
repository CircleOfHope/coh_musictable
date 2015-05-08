<?php

class Ajax extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->add_package_path(APPPATH.'third_party/datamapper');
        $this->load->library('datamapper');
        $this->load->library('session');
        $this->load->database();
        $this->load->model('Song');
        $this->load->model('Attachment');
        $this->load->model('Tag');
        $this->load->helper('form');
    }

    /* ---------
     * Songs
     * --------- */
    public function add_song() {
        if($this->session->userdata('admin') != 'TRUE') {
            echo json_encode(array('success' => false, 'error' => 'action not authorized; not logged in', 'data' => null));
            return;
        }
        $songid = $this->Song->add();
        //header('Content-type: application/x-json');
        echo json_encode(array('success' => true, 'error' => '', 'data' => $songid));
    }

    public function remove_song($id = -1) {
        if($this->session->userdata('admin') != 'TRUE') {
            echo json_encode(array('success' => false, 'error' => 'action not authorized; not logged in', 'data' => null));
            return;
        }
        $id = ($id != -1) ? $id : $_POST['id'];
        $this->Song->remove($id);
        //header('Content-type: application/x-json');
        echo json_encode(array('success' => true, 'error' => '', 'data' => $id));
    }

    /* ---------
     * Attachments
     * --------- */
    public function create_attachment($songid = -1, $name = -1, $url = -1) {
        if($this->session->userdata('admin') != 'TRUE') {
            echo json_encode(array('success' => false, 'error' => 'action not authorized; not logged in', 'data' => null));
            return;
        }
        $songid = ($songid != -1) ? $songid : $_POST['songid'];
        $name = ($name != -1) ? $name : $_POST['name'];
        $url = ($url != -1) ? $url : $_POST['url'];
        
        $attachid = $this->Attachment->add($name, $url);
        $this->Song->add_attachment($songid, $attachid);
        //header('Content-type: application/x-json');
        echo json_encode(array('success' => true, 'error' => '', 'data' => $attachid));
    }

    public function add_attachment() {
        if($this->session->userdata('admin') != 'TRUE') {
            echo json_encode(array('success' => false, 'error' => 'action not authorized; not logged in', 'data' => null));
            return;
        }
        $attachid = $this->Attachment->add();
        //header('Content-type: application/x-json');
        echo json_encode(array('success' => true, 'error' => '', 'data' => $attachid));
    }

    public function remove_attachment($id = -1) {
        if($this->session->userdata('admin') != 'TRUE') {
            echo json_encode(array('success' => false, 'error' => 'action not authorized; not logged in', 'data' => null));
            return;
        }
        $id = ($id != -1) ? $id : $_POST['id'];
        $this->Attachment->remove($id);
        //header('Content-type: application/x-json');
        echo json_encode(array('success' => true, 'error' => '', 'data' => $id));
    }

    public function add_attachment_to_song($attachid = -1, $songid = -1) {
        if($this->session->userdata('admin') != 'TRUE') {
            echo json_encode(array('success' => false, 'error' => 'action not authorized; not logged in', 'data' => null));
            return;
        }
        $attachid = ($attachid != -1) ? $attachid : $_POST['attachid'];
        $songid = ($songid != -1) ? $songid : $_POST['songid'];
        $this->Song->add_attachment($songid, $attachid);
        //header('Content-type: application/x-json');
        echo json_encode(array('success' => true, 'error' => '', 'data' => null));
    }

    public function remove_attachment_from_song($attachid = -1, $songid = -1) {
        if($this->session->userdata('admin') != 'TRUE') {
            echo json_encode(array('success' => false, 'error' => 'action not authorized; not logged in', 'data' => null));
            return;
        }
        $attachid = ($attachid != -1) ? $attachid : $_POST['attachid'];
        $songid = ($songid != -1) ? $songid : $_POST['songid'];
        $this->Song->remove_attachment($songid, $attachid);
        //header('Content-type: application/x-json');
        echo json_encode(array('success' => true, 'error' => '', 'data' => null));
    }

    /* ---------
     * Tags
     * --------- */
    public function add_tag($name = -1) {
        if($this->session->userdata('admin') != 'TRUE') {
            echo json_encode(array('success' => false, 'error' => 'action not authorized; not logged in', 'data' => null));
            return;
        }
        $name = ($name != -1) ? $name : $_POST['name'];
        $tagid = $this->Tag->add($name);
        //header('Content-type: application/x-json');
        echo json_encode(array('success' => true, 'error' => '', 'data' => $tagid));
    }

    public function remove_tag($id = -1) {
        if($this->session->userdata('admin') != 'TRUE') {
            echo json_encode(array('success' => false, 'error' => 'action not authorized; not logged in', 'data' => null));
            return;
        }
        $id = ($id != -1) ? $id : $_POST['id'];
        $this->Tag->remove($id);
        //header('Content-type: application/x-json');
        echo json_encode(array('success' => true, 'error' => '', 'data' => $id));
    }

    public function add_tag_to_song($tagid = -1, $songid = -1) {
        if($this->session->userdata('admin') != 'TRUE') {
            echo json_encode(array('success' => false, 'error' => 'action not authorized; not logged in', 'data' => null));
            return;
        }
        $tagid = ($tagid != -1) ? $tagid : $_POST['tagid'];
        $songid = ($songid != -1) ? $songid : $_POST['songid'];
        $this->Song->add_tag($songid, $tagid);
        //header('Content-type: application/x-json');
        echo json_encode(array('success' => true, 'error' => '', 'data' => null));
    }

    public function remove_tag_from_song($tagid = -1, $songid = -1) {
        if($this->session->userdata('admin') != 'TRUE') {
            echo json_encode(array('success' => false, 'error' => 'action not authorized; not logged in', 'data' => null));
            return;
        }
        $tagid = ($tagid != -1) ? $tagid : $_POST['tagid'];
        $songid = ($songid != -1) ? $songid : $_POST['songid'];
        $this->Song->remove_tag($songid, $tagid);
        //header('Content-type: application/x-json');
        echo json_encode(array('success' => true, 'error' => '', 'data' => null));
    }
}

?>
