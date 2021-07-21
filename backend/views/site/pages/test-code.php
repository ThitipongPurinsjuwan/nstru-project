<?php 
if ( $xlsx = SimpleXLSX::parse('../../images/Jane.xlsx') ) {
    print_r( $xlsx->rows() );
} else {
    echo SimpleXLSX::parseError();
}

 ?>