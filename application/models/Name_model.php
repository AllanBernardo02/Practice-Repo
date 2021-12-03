<!-- need ata capital talaga yung name ng file -->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Name_model extends CI_Model{

    function name_query(){

        return "name query";
    }

    function add_data($data){

        // $this->db->query(); you can also use this with sql queries
        return $this->db->insert("user",$data);
    }
    
    function get_data(){

        $this->db->select("*");
        
        // $this->db->from("user"); 
        // return $this->db->get();  pwede tong dalwa or isa nalang like nung asa baba
        
        // $this->db->where("Name","Jen"); this is use if isa lang yung arg mo

        // this is use for multiple args
   
   
        $this->db->where(
            array(
                "Name"=>"Jen",
                "Last_Name"=> "Uy"

            )
        );


        return $this->db->get("user")->row();  // required table name   


        // if alam mong isa lang ang result ng query mo much better use row(); or row_array(); if madami use result_array(); or result();
        // pag walang _array objects yun

        // result(): will return array of objects

        // SELECT * FROM user   ganyan ang equivalent niyan
    }


    function update_table()
    {
        $updated_data = array(
            "Name"=>"apple",
            "Last_Name" => "Teologo",
            "Email" => "apple@example.com",
            "Password" => "4284",
        );

        $this->db->where("id",3);
        $this->db->update("user",$updated_data);  // required parameters are (table_name and, array of data)

        return true;


    }

    function delete_by_id($user_id)
    {
        // $this->db->where("id",$user_id);
        // $this->db->delete("user");  // required the table name

        // query  = Delete from user where id = $user_id

        $this->db->delete("user", array(
            "id" => $user_id,
        )
        
        );
        
    }

    function where_con()
    {
        $this->db->select("*");
        $this->db->from("user");


        // $this->db->where("Last_Name =", "Teologo");
        // SELECT * FROM user WHERE Last_Name = "Teologo"


        // OR
        // $this->db->where("Last_Name =", "Teologo")->or_where("Last_Name =","Uy");
        
        // SELECT * FROM user WHERE Last_Name = "Teologo" or Last_Name = "Uy"


        // AND
        // $this->db->where(array(
        //     "Last_Name " => "Teologo",
        //     "Email" => "apple@example.com",
        // ));

        // SELECT * FROM user WHERE Last_Name = "Teologo" and Email = "apple@example"


        // IN
        $this->db->where_in("Name", array("apple","Jen")); // 2 parameters (table_name, value you want to that table)


        
        return $this->db->get()->result_array();
    }


    // like wildcards
    function like(){

        $this->db->select("*");
        $this->db->like("Email", "t@","both");  // after, both , none of exact word yung hinahanap mo
        //SELECT * WHERE email like '%example.com%'  ESCAPE '!'  first % meaning neto is may character siya before yung specified word , % after ng specified word ay meaning may work pag katapos niya  
        
        //  hahalsfdsfs   '%ls%'  (both) kase asa gitna siya   'haha$' (after) kase walang word bago siya   '%fs' (before) kase wala ng characcter after niya
  
        

        // meron ring or_like(); just liek how or_where(); works
        return $this->db->get("user")->result_array();

    }




    function types_of_joins()
    {
        $this->db->select("*");  // (user.*) meaning yung table user lang ako i seselect niya, pag (user_msg.*) yung yung user_msg, pag (*) wala both of the table 
        $this->db->from("user");
        $this->db->join("user_msg", "user.id = user_msg.user_id","left");

        // out left table is user and right table is user_msg

        // left join meaning lahat ng laman ni table user ay kasama kahit wla pa silang value sa  user_msg

        // right join meaning lahat ng laman ni table user_msg ay kasama kahit wla pa silang value sa  user


        // SELECT * FROM user JOIN user_msg on user.id = user_msg.user_id;
        return $this->db->get()->result_array();


    }

    function login_validation($username,$password)
    {
        $this->db->where("username",$username);
        $this->db->where("password",$password);
        if($this->db->get("login")->num_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function register_credentials($data)
    {
        $this->db->insert("login",$data);
    }   
    
}

?>