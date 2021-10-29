<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TestController extends CI_Controller
{
    function User()
    {
        $this->load->library('session');
    }

    function login()
    {
        $this->session->set_userdata('login_token', true);
        echo 'finished logging in';
    }

    function logout()
    {
        $this->session->unset_userdata('login_token');
        echo 'finished logging out';
    }

    function status()
    {
        if ($this->session->userdata('login_token'))
        {
            echo 'logged in';
        }
        else
        {
            echo 'not logged in';
        }
    }
}