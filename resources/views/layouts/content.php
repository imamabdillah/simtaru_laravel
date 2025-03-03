<?php
if (isset($isi)){
    if(isset($data)){
        $this->load->view( $isi, $data );
    }else{
        $this->load->view( $isi );
    }
}else{
    $this->load->view( 'layouts/default' );
}