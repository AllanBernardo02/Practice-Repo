<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Example extends CI_Controller {

    // public function __construct()
    // {
    //     parent::__construct(); // this is important
    //     //$this->load->model("example_model");   //this is how you import the a file model  | pwede ring tangalin to at ilagay sa autoload.php
    // }

	public function index()
	{

		$this->load->view('sample/example_index');
	}

    public function hello($name)
    {
        echo "<h1>Hello my name is: {$name}</h1>";
    }

    public function pass_var()
    {
        echo $this->example_model->another_one();
        echo $this->example_model->sample_query();

        echo $this->name_model->name_query();

        $this->load->view('sample/var.php', array(
            "name" => "john",
            "age" => 19,

        ));
    }

    public function add_data(){
    
        $this->name_model->add_data(
            array( 
                "Name"=>"john",
                "Last_Name"=>"teologo",
                "Email"=>"t@example.com",
                "Password"=>"1234"

            )
        );
    
    }

    public function display_data()
    {
        $data = $this->name_model->get_data();
        echo "<pre>";
        print_r(json_encode($data));
    }

    public function update_data()
    {

        if ($this->name_model->update_table()){  // yung name_model ay case sensitive depende sa nilagay mo sa autoload.php or sa constructor

            echo "<h1>Updated</h1>";
        }

    }


    public function delete($user_id)
    {
        $this->name_model->delete_by_id($user_id);
    }


    public function where_condition()
    {
        $data = $this->name_model->where_con();
        echo "<pre>";
        print_r($data);
    }


    public function likewise(){

        $data =  $this->name_model->like();

        echo "<pre>";
        print_r($data);
    }


    public function joins()
    {
         $data =  $this->name_model->types_of_joins();

        echo "<pre>";
        print_r($data);
    }


    public function create_form(){
        $this->load->view("sample/form");

    }

    public function display_form()
    {
        $config_rules = array(
            array(
                "field" => "name_txt",
                "label" => "Name",
                "rules" =>"required|min_length[6]|max_length[20]|trim", // trim will remove excess spaces
            ),
            array(
                "field" => "last_name_txt",
                "label" => "Lastname",
                "rules" =>"required",
            ),
            array(
                "field" => "email_txt",
                "label" => "Email",
                "rules" =>"required|callback_is_email_exsisting|is_unique[user.Email]",
            ), 
            array(
                "field" => "pass_txt",
                "label" => "Password",
                "rules" =>"required",
            ),  
   
        );

        // $this->form_validation->set_rules("name_txt","Name","required|min_length[6]|max_length[20]|trim"); // trim will remove excess spaces
        // $this->form_validation->set_rules("last_name_txt","Lastname","required"); // you can alse add functions inside this
        // $this->form_validation->set_rules("email_txt","Email","required|callback_is_email_exsisting");
        // $this->form_validation->set_rules("pass_txt","Password","required");
        $this->form_validation->set_rules($config_rules);

        if($this->form_validation->run() == false){

            $this->create_form(); // redirectiong in php
        }
        else
        {

            $data = $this->input->post();
            if(!empty($data)){
                 $data_array =  array( 
                "Name"=>$data['name_txt'],
                "Last_Name"=>$data['last_name_txt'],
                "Email"=>$data['email_txt'],
                "Password"=>$data['pass_txt']
            );
            }
            if($this->name_model->add_data($data_array)){
                $this->session->set_flashdata("success","user has been created");
                unset($data);
                redirect("example/form",'refresh');
            }
            else{
                $this->session->set_flashdata("error","user has been not created");
                unset($data);
                redirect("example/form",'refresh');
        
            }    

        }

    }




    public function login()
    {
        // unset($_SESSION['wrong']);
        $this->load->view("sample/login");
    }

    public function login_logic()
    {
        unset($_SESSION['wrong']); // use to clear flash data
        $config_rules = array(
            array (
                "field" => "username_txt",
                "label" => "Username",
                "rules" =>"required",
            ),
             array(
                "field" => "password_txt",
                "label" => "Password",
                "rules" =>"required",
            ),  
        );
        $this->form_validation->set_rules($config_rules);
        if($this->form_validation->run() == false){

            $this->login(); // run this function again
        }
        else
        {
            $username = $this->input->post("username_txt");
            $password = $this->input->post("password_txt");

            if($this->name_model->login_validation($username,$password))
            {
                $session_data = array(
                    'username' => $username
                );
                $this->session->set_userdata($session_data);
                redirect("example/afterlog");
            }
            else{
                $this->session->set_flashdata("wrong", "You input wrong values!");
                redirect("example/login");
            }
            }
        
    }
    // base_url walang index.php sa url path
    // site_url may index.php sa url path

    public function after_login()
    {
        if($this->session->userdata("username") != "")
        {
            $user = $this->session->userdata("username"); 
            $this->load->view("sample/afterlogin", array
        (
            "username" => $user,
            "dog" => "hello",
        ));
        }
        else{
            redirect("example/login");
        }
    }


    public function logout()
    {
        $this->session->unset_userdata("username");
        redirect("example/login");

    }

    public function register()
    {
        $this->load->view("sample/register");
    }


    public function register_method()
    {
        unset($_SESSION['wrong']);
         unset($_SESSION['not_equal']);
           $config_rules = array(
            array (
                "field" => "username_txt",
                "label" => "Username",
                "rules" =>"required|is_unique[login.username]",
            ),
             array(
                "field" => "password1_txt",
                "label" => "Password",
                "rules" =>"required|min_length[8]|max_length[20]",
            ),   
            array(
                "field" => "password2_txt",
                "label" => "rewrite-Password",
                "rules" =>"required|min_length[8]|max_length[20]",
            ),  
        );

        $this->form_validation->set_rules($config_rules);

        if($this->form_validation->run() == false)
        {
            $this->register();
        }
        else
        {
            $username = $this->input->post("username_txt");
            $password1 = $this->input->post("password1_txt");
            $password2 = $this->input->post("password2_txt");

            if($password1 != $password2)
            {
                $this->session->set_flashdata("not_equal", "Your passwrods are not the same");
                $this->register();
            }
            else
            {
                $this->name_model->register_credentials(
                    array(
                        "username" => $username,
                        "password" => $password1,
                    )
                    );
                redirect("example/login");
                
            }
        }

    }
}

