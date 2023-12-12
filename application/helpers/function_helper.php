<?php

function get_category($id = null)
{
    $ci = get_instance();

    if ($id == null) {
        return $ci->main->get('category');
    } else {
        $query = $ci->main->get_where('category', ['category_id' => $id]);
        return $query->category_name;
    }
}


function setMsg($type, $strong, $msg)
{
    $ci = get_instance();

    // Alert
    $text = "";
    $text .= "<div class='alert alert-{$type} alert-dismissible show' role='alert'>";
    $text .= "<strong>{$strong}</strong> ".$msg;
    $text .= ' <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>';
    $text .= "</div>";
    return $text;
}

function setFlashMsg($type, $strong, $msg)
{
    $ci = get_instance();

    // Alert
    $text = "";
    $text .= "<div class='alert alert-{$type} alert-dismissible text-white' role='alert'>";
    $text .= " <span class='text-sm'><b class='alert-link text-white'>{$strong}</b> {$msg}</span>";
    $text .= '
	<button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
	<span aria-hidden="true">&times;</span>
  </button>
</div>
	';
    return $ci->session->set_flashdata('msg', $text);
}

function userdata()
{
    $ci = get_instance();

    $user_id = $ci->session->userdata("user_session");
    $user = $ci->main->get_where("users", ["user_id" => $user_id]);
	return $user;

   
}
 
function active_menu($page)
{
    $ci = get_instance();
    $uri = $ci->uri->segment(1);

    return $uri == $page ? "active" : "";
}

function check($data1, $data2, $result = "active")
{
    return $data1 == $data2 ? $result : "";
}

function user_initial($name)
{
    return substr($name, 0, 1);
}

function custom_date($format, $date)
{
    return date($format, strtotime($date));
}

function check_session()
{
    if (!userdata()) {
        setFlashMsg('danger', 'Access Denied! ', 'harap login untuk masuk ke dashboard');
        redirect('auth');
    }
}

function get_barang()
{
    $ci = get_instance();
	$barang = $ci->main->get('tb_barang');
	return $barang;
}
