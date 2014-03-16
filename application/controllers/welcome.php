<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -  
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $i = new Ingredient();
        $i->name = 'test';
        $i->link = 'www.test.com';
        $i->description = "tjis is a nda dthasd as adfhajs igsd ijsgdoj sgoius g";

        if($i->save()) {
            echo "i save success! <br/>";
        } else {
            echo "i save fail <br/>";
        }

        $r = new Recipe();
        $r->title = 'fucking CI';
        $r->type = 'main';
        $r->serves = 21;

        if($r->save()) {
            echo "r save success! <br/>";
        } else {
            echo "r save fail <br/>";
        }

        $s = new Step();
        $s->operation = 'OP';

        if($s->save()) {
            echo "s save success! <br/>";
        } else {
            echo "s save fail <br/>";
        }

        $foo = new Recipe();
        $foo->where('id',1)->get();//get the first recepe
        $foo->step->get();

        foreach ($foo->step as $step) {
            echo 'STEP ID ' . $step->id . '<br/>';
            echo 'STEP OP ' . $step->operation . '<br/>';

            $step->ingredient->get();
            foreach ($step->ingredient as $in) {
                echo 'INGREDIENT ID ' . $in->id . '<br/>';
                echo 'NAME ' . $in->name . '<br/>';
                echo 'DESC ' . $in->description . '<br/>';
                echo 'LINK ' . $in->link . '<br/>';
            }

            echo '<br/>';
        }
        //$this->load->view('welcome_message');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */