<?php

function is_logged_in()
{
    $ci = get_instance();
    if(!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);

        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];

        $userAkses = $ci->db->get_where('user_akses_menu', ['role_id' => $role_id, 
                                                            'menu_id' => $menu_id]);

        if($userAkses->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}

function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('user_akses_menu');
    if($result->num_rows() > 0) {
        return "checked='checked'";
    }
}