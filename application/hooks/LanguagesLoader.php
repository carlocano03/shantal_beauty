<?php

class LanguagesLoader {
    function initialize() {
        $ci = & get_instance();
        $ci->load->helper( 'language' );
        $siteLang = $ci->session->userdata( 'site_lang' );
        if ( $siteLang ) {
            $ci->lang->load( 'common', $siteLang );
        } else {

            $ci->lang->load( 'common', 'english' );
        }
    }
}

?>